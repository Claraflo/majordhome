<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] != 0) {
    header('Location: ../login.php');
}

if (!isset($_SESSION['dateTime']) || !isset($_SESSION['idSubscription'])){
    header('Location: subscription.php');
}

require("../functions.php");
$connect = connectDb();

$priceSubscription = $_SESSION['priceSubscription'];
$dateTime = $_SESSION['dateTime'];
$idSubscription = $_SESSION['idSubscription'];
$number = $_SESSION['numberSubscription'];
unset($_SESSION['dateTime']);
unset($_SESSION['idSubscription']);


$date = explode(":", $dateTime);

$days = date('d') + $date[2];
$months = date('m') + $date[1];
$years = date('Y') + $date[0];
$time = date('H:i:s');

$endTime = $years.'-'.$months.'-'.$days.' '.$time;

$format = 'Y-m-d H:i:s';
$date = DateTime::createFromFormat($format, $endTime);

function pwdGenerator($numberCaracteres, $string = 'abcdefghigklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789')
{
    $numberLetters = strlen($string) - 1;
    $generation = '';
    for($i=0; $i < $numberCaracteres; $i++)
    {
        $pos = mt_rand(0, $numberLetters);
        $caractere = $string[$pos];
        $generation .= $caractere;
    }
    return $generation;
}


$idSouscriptionAbonnement = pwdGenerator(10);


checkId($idSouscriptionAbonnement, $connect);

function checkId($idSouscriptionAbonnement, $connect)
{
    $query = $connect->query('SELECT idSouscriptionAbonnement FROM souscription_abonnement;');
    $query->execute();
    foreach ($query->fetchAll() as $value) {

        if ($idSouscriptionAbonnement == $value['idSouscriptionAbonnement']) {
            $idSouscriptionAbonnement = pwdGenerator(10);
            checkId($idSouscriptionAbonnement, $connect);
        }

    }
}


$req = $connect->prepare('INSERT INTO souscription_abonnement(idSouscriptionAbonnement, dateFin, FK_idPersonne, FK_idAbonnement, statut) VALUES(:idSouscriptionAbonnement, :date, :FK_idPersonne, :FK_idSubscription, :statut)');
$req->execute([':idSouscriptionAbonnement'=> $idSouscriptionAbonnement,
    ':date'=>$endTime,
    ':FK_idPersonne'=>  $_SESSION['user']['idPersonne'],
    ':FK_idSubscription'=>  $idSubscription,
    ':statut'=> 0
]);

if ($number != 1) {
    $req = $connect->prepare('INSERT INTO facture(prixTotal, sommeVersee, sommeRestante, statut, FK_idPersonne, FK_idSouscriptionAbonnement) VALUES(:prixTotal, :sommeVersee, :sommeRestante, :statut, :FK_idPersonne, :FK_idSouscriptionAbonnement)');
    $req->execute([':prixTotal' => $priceSubscription,
        ':sommeVersee' => $priceSubscription / $number,
        ':sommeRestante' => $priceSubscription - ($priceSubscription / $number),
        ':statut' => 0,
        ':FK_idPersonne' => $_SESSION['user']['idPersonne'],
        ':FK_idSouscriptionAbonnement' => $idSouscriptionAbonnement
    ]);
}else{
    $req = $connect->prepare('INSERT INTO facture(prixTotal, sommeVersee, sommeRestante, statut, FK_idPersonne, FK_idSouscriptionAbonnement, dateFinFacturation) VALUES(:prixTotal, :sommeVersee, :sommeRestante, :statut, :FK_idPersonne, :FK_idSouscriptionAbonnement, :dateFinFacturation)');
    $req->execute([':prixTotal' => $priceSubscription,
        ':sommeVersee' => $priceSubscription / $number,
        ':sommeRestante' => $priceSubscription - ($priceSubscription / $number),
        ':statut' => 1,
        ':FK_idPersonne' => $_SESSION['user']['idPersonne'],
        ':FK_idSouscriptionAbonnement' => $idSouscriptionAbonnement,
        ':dateFinFacturation'=> date('Y-m-d H:i:s')
    ]);
}

header('Location: success.php');
?>