<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] != 0) {
    header('Location: ../login.php');
}

if (!isset($_SESSION['idService']) || !isset($_SESSION['idCaracteristique']) || !isset($_SESSION['valueService']) || !isset($_SESSION['priceService'])){
    header('Location: services.php');
}

require("../functions.php");
$connect = connectDb();

$idService = $_SESSION['idService'];
$idCaracteristique = $_SESSION['idCaracteristique'];
$valueService = $_SESSION['valueService'];
$priceService = $_SESSION['priceService'];
unset($_SESSION['idService']);
unset($_SESSION['idCaracteristique']);
unset($_SESSION['valueService']);


$number = $valueService[count($valueService)-1];

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

$idSouscriptionService = pwdGenerator(10);


checkId($idSouscriptionService, $connect);

function checkId($idSouscriptionService, $connect)
{
    $query = $connect->query('SELECT idSouscriptionService FROM souscription_service;');
    $query->execute();
    foreach ($query->fetchAll() as $value) {

        if ($idSouscriptionService == $value['idSouscriptionService']) {
            $idSouscriptionService = pwdGenerator(10);
            checkId($idSouscriptionService, $connect);
        }

    }
}




$req = $connect->prepare('INSERT INTO souscription_service(FK_idPersonne, FK_idService, dateIntervention, duree, idSouscriptionService, statutReservation) VALUES(:FK_idPersonne, :FK_idService, :dateIntervention, :duree, :idSouscriptionService, :statutReservation)');
$req->execute([':FK_idPersonne'=>  $_SESSION['user']['idPersonne'],
    ':FK_idService'=>  $idService,
    'dateIntervention'=>  $valueService[0],
    'duree'=>  $valueService[1],
    'idSouscriptionService'=> $idSouscriptionService,
    'statutReservation'=> 0
]);


for ($i = 0; $i < count($idCaracteristique); $i++){
$req = $connect->prepare('INSERT INTO donnees_service(information, FK_idSouscriptionService, FK_idCaracteristique) VALUES(:information, :FK_idSouscriptionService, :FK_idCaracteristique)');
$req->execute([':information'=> $valueService[$i+2],
    ':FK_idSouscriptionService'=> $idSouscriptionService,
    ':FK_idCaracteristique'=> $idCaracteristique[$i]
]);
}

if ($number != 1) {
    $req = $connect->prepare('INSERT INTO facture(prixTotal, sommeVersee, sommeRestante, statut, FK_idPersonne, FK_idSouscriptionService) VALUES(:prixTotal, :sommeVersee, :sommeRestante, :statut, :FK_idPersonne, :FK_idSouscriptionService)');
    $req->execute([':prixTotal' => $priceService,
        ':sommeVersee' => $priceService / $number,
        ':sommeRestante' => $priceService - ($priceService / $number),
        ':statut' => 0,
        ':FK_idPersonne' => $_SESSION['user']['idPersonne'],
        ':FK_idSouscriptionService' => $idSouscriptionService
    ]);
}else{
    $req = $connect->prepare('INSERT INTO facture(prixTotal, sommeVersee, sommeRestante, statut, FK_idPersonne, FK_idSouscriptionService, dateFinFacturation) VALUES(:prixTotal, :sommeVersee, :sommeRestante, :statut, :FK_idPersonne, :FK_idSouscriptionService, :dateFinFacturation)');
    $req->execute([':prixTotal' => $priceService,
        ':sommeVersee' => $priceService / $number,
        ':sommeRestante' => $priceService - ($priceService / $number),
        ':statut' => 1,
        ':FK_idPersonne' => $_SESSION['user']['idPersonne'],
        ':FK_idSouscriptionService' => $idSouscriptionService,
        ':dateFinFacturation' => date('Y-m-d H:i:s')
    ]);
}

header('Location: success.php');
?>