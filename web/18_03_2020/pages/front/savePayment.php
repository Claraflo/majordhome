<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] != 0) {
    header('Location: ../login.php');
}

if (!isset($_SESSION['pricePayment']) || !isset($_SESSION['numberPayment'])){
    header('Location: history.php');
}

$pricePayment = $_SESSION['pricePayment'];
$numberPayment = $_SESSION['numberPayment'];

unset($_SESSION['pricePayment']);
unset($_SESSION['numberPayment']);

require("../functions.php");
$connect = connectDb();


for ($i = 0; $i < count($numberPayment); $i++){
    $req = $connect->prepare("UPDATE versement set somme =:somme, statut =:statut, datePaiement =:datePaiement WHERE idVersement =:id;");
    $req->execute([':somme'=>$pricePayment/count($numberPayment),
        ':statut'=> 1,
        ':datePaiement'=> date('Y-m-d H:i:s'),
        ':id'=>$numberPayment[$i]
    ]);
}




header('Location: success.php');
?>