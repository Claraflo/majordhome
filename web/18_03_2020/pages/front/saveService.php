<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] != 0) {
    header('Location: ../login.php');
}

require("../functions.php");
$connect = connectDb();

$idService = $_SESSION['idService'];
$idCaracteristique = $_SESSION['idCaracteristique'];
$valueService = $_SESSION['valueService'];
unset($_SESSION['idService']);
unset($_SESSION['idCaracteristique']);
unset($_SESSION['valueService']);


for ($i = 0; $i < count($idCaracteristique); $i++){
    print_r($idCaracteristique[$i]);
    echo "=>";
    print_r($valueService[$i+2]);
}


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

echo pwdGenerator(10);


$req = $connect->prepare('INSERT INTO souscription_service(FK_idPersonne, FK_idService, dateIntervention, duree, idSouscriptionService, statutReservation) VALUES(:FK_idPersonne, :FK_idService, :dateIntervention, :duree, :idSouscriptionService, :statutReservation)');
$req->execute([':FK_idPersonne'=>  $_SESSION['user']['idPersonne'],
    ':FK_idService'=>  $idService,
    'dateIntervention'=>  $valueService[0],
    'duree'=>  $valueService[1],
    'idSouscriptionService'=> pwdGenerator(10),
    'statutReservation'=> 0
]);

//header('Location: success.php');
?>