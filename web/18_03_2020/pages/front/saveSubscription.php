<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] != 0) {
header('../Location: login.php');
}

require("../functions.php");
$connect = connectDb();

$endTime = $_SESSION['endTime'];
unset($_SESSION['endTime']);

$format = 'Y-m-d H:i:s';
$date = DateTime::createFromFormat($format, $endTime);

$req = $connect->prepare('INSERT INTO souscription_abonnement(dateFin) VALUES(:date)');
$req->execute([':date'=>$endTime
]);


?>