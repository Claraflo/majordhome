<?php
session_start();
if (!isset($_SESSION['user']) || ($_SESSION['user']['statut'] != 2 && $_SESSION['user']['statut'] != 3 )) {
	header('Location: ../index.php');
}

function connectDb(){

	try{

		$connect = new PDO("mysql:host=localhost;dbname=majordhome;port=3306","root","root");

	}catch(Exception $e){
					
		die("Erreur SQL".$e->getMessage());
	}

	return $connect;

}


?>
