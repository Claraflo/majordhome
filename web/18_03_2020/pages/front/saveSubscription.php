<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] != 0) {
header('../Location: login.php');
}

require("../functions.php");
$connect = connectDb();

$endTime = $_SESSION['endTime'];
$idSubscription = $_SESSION['idSubscription'];
unset($_SESSION['endTime']);
unset($_SESSION['idSubscription']);

$format = 'Y-m-d H:i:s';
$date = DateTime::createFromFormat($format, $endTime);

$req = $connect->prepare('INSERT INTO souscription_abonnement(dateFin, FK_idPersonne, FK_idAbonnement) VALUES(:date, :FK_idPersonne, :FK_idSubscription)');
$req->execute([':date'=>$endTime,
    ':FK_idPersonne'=>  $_SESSION['user']['idPersonne'],
    ':FK_idSubscription'=>  $idSubscription
]);

header('Location: success.php');
?>