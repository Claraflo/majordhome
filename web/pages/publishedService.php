<?php
require("functions.php");

if (isset($_POST['id'])) {


$connect = connectDb();

$queryPrepared = $connect->prepare("UPDATE Service SET statut = 1 WHERE idService = :id");
$res = $queryPrepared->execute([":id" => $_POST['id']]);

if($res == True){


	echo "<div class='alert alert-success'>Service publié !</div>";
}


}