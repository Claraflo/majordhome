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

$dateTime = $_SESSION['dateTime'];
$idSubscription = $_SESSION['idSubscription'];
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

$req = $connect->prepare('INSERT INTO souscription_abonnement(dateFin, FK_idPersonne, FK_idAbonnement) VALUES(:date, :FK_idPersonne, :FK_idSubscription)');
$req->execute([':date'=>$endTime,
    ':FK_idPersonne'=>  $_SESSION['user']['idPersonne'],
    ':FK_idSubscription'=>  $idSubscription
]);

header('Location: success.php');
?>