<?php
session_start();
require("pages/functions.php");
$connect = connectDb();


if (isset($_POST['email']) && isset($_POST['pwd'])) {

	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	


		$queryPrepared = $connect->prepare('SELECT * FROM personne WHERE mail = :email');
		$queryPrepared->execute([':email' => $email]);
		$user = $queryPrepared->fetch();




			if (password_verify($pwd,$user['mdp']) &&  $user['statut'] == 0) {

				$_SESSION['user'] = $user;
				header('Location: front/services.php');
				
			} else if (password_verify($pwd,$user['mdp']) &&  ($user['statut'] == 2 || $user['statut'])){
                $_SESSION['user'] = $user;
                header('Location: back/subscriptionBack.php');
			}else{

				$error =  "Identifiants incorrects";
				$_SESSION['errorsAuth'] = $error;
				header('Location: login.php');
			}


}

