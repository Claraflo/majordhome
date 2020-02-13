<?php
require("functions.php");
session_start();

if (isset($_POST['email']) && isset($_POST['pwd'])) {

	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	
		$connect = connectDb();

		$queryPrepared = $connect->prepare('SELECT idPersonne,nom,prenom,pwd FROM Personne WHERE mail = :email');
		$queryPrepared->execute([':email' => $email]);
		$arrayPwd = $queryPrepared->fetch();


			if (password_verify($pwd,$arrayPwd['pwd'])) {

				$_SESSION['auth'] = true;
				$_SESSION['nom'] = $arrayPwd['nom'];
				$_SESSION['id'] = $arrayPwd['idPersonne'];

				header('Location: services.php');
				
			}else{

				$error =  "Identifiants incorrects";
				$_SESSION['errorsAuth'] = $error;

				header('Location: login.php');
			}


}

