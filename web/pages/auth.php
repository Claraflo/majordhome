<?php
session_start();

if (isset($_POST['email']) && isset($_POST['pwd'])) {

	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	
		// $connect = connectDb();

		// $queryPrepared = $connect->prepare('SELECT id_users,nom,pwd FROM Utilisateurs WHERE email = :email AND confirmkey = 1');
		// $queryPrepared->execute([':email' => $email]);
		// $arrayPwd = $queryPrepared->fetch();


			if (password_verify($pwd,$arrayPwd['pwd'])) {

				// $_SESSION['auth'] = true;
				// $_SESSION['nom'] = $arrayPwd['nom'];
				// $_SESSION['id'] = $arrayPwd['id_users'];

				//header('Location:pages/pilotage.php');
				
			}else{

				$error =  "Identifiants incorrects";
				$_SESSION['errorsAuth'] = $error;

				header('Location: login.php');
			}


}

