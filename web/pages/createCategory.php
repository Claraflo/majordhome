<?php
require('functions.php');
if (isset($_POST['name']) && !empty($_POST['name'])) {


	$name = trim($_POST['name']);
	

	if (isset($_POST['description']) && $name != "") {


		$connect = connectDb();

		$description = trim($_POST['description']);
		
		$queryPrepared = $connect->prepare("INSERT INTO Categorie(nom,description) VALUES(:name,:description);");
		$queryPrepared->execute([
			":name"=>$name,
			":description"=>$description
		]);


		echo "<div class='alert alert-success'>Catégorie créée ! </div>";

	}else{

		echo "<div class='alert alert-danger'>Erreur de saisie !</div>";

	}


}else{

	echo "<div class='alert alert-danger'> Vous devez obligatoirement saisir le nom de la catégorie !</div>";

}