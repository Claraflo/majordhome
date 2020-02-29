<?php
session_start();
require('functions.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/services.css">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Lien Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Lien police d'écriture -->
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

  <!-- Lien Icon -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand active" href="index.php" title="">
                <img class="logo" src="../img/majordhome.png" title="logo" alt="Logo Majord'home">
            </a>


    	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        	<span class="navbar-toggler-icon"></span>
      </button>
    	
    	<div class="collapse navbar-collapse" id="navbarNav">
      		<ul class="navbar-nav ml-auto">
        		<li class="nav-item ">
         			<a class="nav-link colorLink active" href="services.php" title="">Services
                	
              		</a>
        		
        		
        		<li class="nav-item ">
         			<a class="nav-link colorLink" href="#" title="">Abonnements</a>
        		
        		

            <li class="nav-item">
              <a class="nav-link colorLink" href="#" title="">Boîte de réception</a>
        		
          		
          	<li class="nav-item">

          		 <a class="nav-link colorLink" href="#" title="">Mon compte</a>


          		<li class="nav-item">

          		  <a href="nav-link"><button class="btn btnServices">Déconnexion</button></a> 
          		

        	</ul>
    	</div>
        </div>
    </nav>


    <div class="masthead">
      

      <div class="containHeader">Découvrez nos services haut de gamme !</div>
    </div>

</header>


<section class="pt-5 servicesSection">

<div class="container">


  <div class="row">


<div class="col-md-7">

<div class="form">


<div class="input-group">
  <select class="custom-select" id="inputGroupSelect01">
    <option selected>Sélectionnez une catégorie de service ...</option>


  <?php

    $connect = connectDb();
    $query = $connect->query('SELECT idCategorie,nom FROM Categorie;');
    $query->execute();
   

    foreach ($query->fetchAll() as $value) {
      
        echo "<option value='1'>".$value['nom']."</option>";

  }

 ?>
   
   
  </select>


</div>
</div>

</div>

<div class="col-md-5">
  
  <a href="#"><button class="btn btnServices">Demande de service</button></a>
</div>

</div>

<div class="row pt-5 ">
  <div class="col-md-3">
        
    <div class="card servicesCard">
      <div class="card-header cardHeader">
        <h5 class="text-center">Serveur</h5>
      </div>

      <div class="card-body text-center">
            
        <h3 class="card-title">22 € <small>/h</small></h3>

        <p>Lorem ipsum</p>

        <a href="#" class="btn btnServices btn-block ">Réserver</a>

      </div>
   </div>
 </div>

   <div class="col-md-3">
        
    <div class="card servicesCard">
      <div class="card-header cardHeader">
        <h5 class="text-center">Serveur</h5>
      </div>

      <div class="card-body text-center">
            
        <h3 class="card-title">22 € <small>/h</small></h3>

        <p>Lorem ipsum</p>

        <a href="#" class="btn btnServices btn-block ">Réserver</a>

      </div>
   </div>
 </div>


   <div class="col-md-3">
        
    <div class="card servicesCard">
      <div class="card-header cardHeader">
        <h5 class="text-center">Serveur</h5>
      </div>

      <div class="card-body text-center">
            
        <h3 class="card-title">22 € <small>/h</small></h3>

        <p>Lorem ipsum</p>

        <a href="#" class="btn btnServices btn-block ">Réserver</a>

      </div>
   </div>
 </div>



   <div class="col-md-3">
        
    <div class="card servicesCard">
      <div class="card-header cardHeader">
        <h5 class="text-center">Serveur</h5>
      </div>

      <div class="card-body text-center">
            
        <h3 class="card-title">22 € <small>/h</small></h3>

        <p>Lorem ipsum</p>

        <a href="#" class="btn btnServices btn-block ">Réserver</a>

      </div>
   </div>
 </div>



</div>

</section>













<footer class="container-fluid footer">
    <div class="container">
        <p class="text-center pt-4">Copyright © Majord'home 2020</p>
    </div>





</footer>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>