<?php
session_start ();

if (!isset($_SESSION['user']) || ($_SESSION['user']['statut'] != 2 && $_SESSION['user']['statut'] != 3)) {
    header('Location: ../login.php');
}

require("../functions.php");
$connect = connectDb();

if(!empty($_POST['idSouscriptionService'])) {

    $idSouscriptionService = $_POST['idSouscriptionService'];


    $req = $connect->prepare("UPDATE souscription_service set statutReservation =:statut WHERE idSouscriptionService =:id;");
    $req->execute([
        ':statut'=>-1,
        ':id'=>$idSouscriptionService
    ]);

    $req = $connect->prepare("UPDATE facture set statut =:statut WHERE FK_idSouscriptionService =:id;");
    $req->execute([
        ':statut'=>-1,
        ':id'=>$idSouscriptionService
    ]);

}



?>