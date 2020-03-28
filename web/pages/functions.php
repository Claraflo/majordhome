<?php

function connectDb(){

	try{

		$connect = new PDO("mysql:host=localhost;dbname=majord'home;port=3306","root","root"); 

	}catch(Exception $e){
					
		die("Erreur SQL".$e->getMessage());
	}

	return $connect;

}


function updateMsgAutomatic(){


	$connect = connectDb();
	$date = date('Y-m-d H:i:s');
	$date = strtotime(date("Y-m-d H:i:s", strtotime($date)) . " -1 week"); 
	$date = date('Y-m-d H:i:s', $date);

	$query = $connect->prepare('UPDATE Messagerie SET statutSource = -1 WHERE dateEnvoie < ? ');
	$res = $query->execute([$date]);

}


?>