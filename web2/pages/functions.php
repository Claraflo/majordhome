<?php

function connectDb(){

	try{

		$connect = new PDO("mysql:host=localhost;dbname=majordhome;port=3306","root","root");

	}catch(Exception $e){
					
		die("Erreur SQL".$e->getMessage());
	}

	return $connect;

}

?>
