<?php
require('../functions.php');
session_start();

if(!empty($_POST['name'])
    && !empty($_POST['price'])
    && !empty($_POST['selectValue'])
   
){

	$name = trim($_POST['name']);
	$description = trim($_POST['description']);
	$price = $_POST['price'];
	$selectValue = $_POST['selectValue'];

	$errors = [];


	if(strlen($name)<2 || strlen($name)>80){
    			
    	$errors[]= "nom trop court ou trop long ! ";
   	}
    		
    if(strlen($description)>150){
    				
    	$errors[]= "Votre description doit être inférieur à 150 caractères !";
   	}

   	$connect = connectDb();


   	$queryPrepared = $connect->prepare("SELECT idCategorie,nom FROM Categorie WHERE nom = :nom");
   	$queryPrepared->execute([":nom" => $selectValue]);
   	$data = $queryPrepared->fetch(PDO::FETCH_ASSOC);


   	if (empty($data)) {

   		$errors[]= "La catégorie n'existe pas ";
   		
   	}


   	// if (!is_float($price)) {


   	// 	$errors[]= "Le prix doit être en format FLOAT.";
   	// 	echo $price;
   	
   	// }



   	if (empty($errors)) {
   		
		$connect = connectDb();

				

		$queryPrepared = $connect->prepare("INSERT INTO Service(nom,description,prix,statut,idCategorie) VALUES (:nom,:description,:prix,0,:idCategorie)");

				

		$queryPrepared->execute([

					":nom"=>$name, 
					":description"=>$description, 
					":prix"=>$price, 
					":idCategorie"=>$data["idCategorie"]
					

				]);


		echo "<div class='alert alert-success'>Votre service à bien été crée ! </div>";


	

   	}else{

   		echo "<div class='alert alert-danger'>";
   			foreach ($errors as  $value) {
				echo "<li>".	$value. "</li>";
	
   			}

   		echo "</div>";

   	}

}else{


		echo "<div class='alert alert-danger'>Erreur de saisie ! </div>";
}