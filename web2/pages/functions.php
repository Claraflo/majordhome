<?php

function connectDb(){

	try{

		$connect = new PDO("mysql:host=localhost;dbname=majordhome;port=3306","root","root");

	}catch(Exception $e){
					
		die("Erreur SQL".$e->getMessage());
	}

	return $connect;

}

function json($path){
	// chemin d'accès à votre fichier JSON
	$file = $path;
	// mettre le contenu du fichier dans une variable
	$data = file_get_contents($file);
	// décoder le flux JSON
	$obj = json_decode($data);

	return $obj;

}

?>
