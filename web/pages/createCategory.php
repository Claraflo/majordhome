<?php
require('functions.php');
if (isset($_POST['name'])) {


	$name = $_POST['name'];
	$connect = connectDb();

	if (isset($_POST['description'])) {

		$description = $_POST['description'];
		
		$queryPrepared = $connect->prepare("INSERT INTO Categorie(nom,description) VALUES(:name,:description);");
		$queryPrepared->execute([
			":name"=>$name,
			":description"=>$description
		]);


		echo "<div class='alert alert-success'>Catégorie créée ! </div>";

	}else{


		$queryPrepared = $connect->prepare("INSERT INTO Categorie(nom) VALUES(:name);");
		$queryPrepared->execute([
			":name"=>$name
			
		]);


		echo "<div class='alert alert-success'>Catégorie créée ! </div>";


	}


}else{

	echo "<div class='alert alert-success'> Erreur ! </div>";

}