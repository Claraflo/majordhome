<?php
require('functions.php');
session_start();
$connect = connectDb();

$query = $connect->query('SELECT nom FROM Categorie;');
$query->execute();


?>
<!DOCTYPE html>
<html>
<head>
	<title>Catégorie</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/servicesBack.css">
	<link rel="stylesheet" type="text/css" href="../css/headerBack.css">
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

<?php require('headerBack.php'); ?>

<section>


<div id="information"></div>

<div class="title text-center pt-4">
	<h1>Gestion des services</h1>
	<hr class="hr">
</div>

<div class="container-fluid pt-3">

	
	<a href="servicesBack.php"><button class="btn btnService"><i class="fas fa-eye"> </i> Liste des services</button></a>
	<hr>

</div>



<div class="container-fluid pt-3">
	<div class="row">
		<div class="col-md-8">
			<div>
				<h4>Liste des services non publié</h4>
				<hr>
			</div>

			<div id="table"></div>

		</div>


		<div class="col-md-4">
			<div class="form">
				<div class="title pb-3">
		
					<h4>Créer un service</h4>
				
				</div>

			 
  			

  				
  					 <div class="form-group">
       	
	       			<label>Nom du service *</label>
	       			<input type="text" id="name"  class="form-control" required="required" placeholder="Plombier">
      				</div>

              <p>Prix du service /h*</p>


      				<div class="row">
      				<div class="col-md-6">

      					<div class="form-group">
       	
       				<label>Euros</label>
       				<input type="number" id="priceEur" class="form-control" required="required" placeholder="12">
      				</div>
					</div>
          

            <div class="col-md-6">

                <div class="form-group">
        
              <label>Centimes</label>
              <input type="number" id="priceCent" class="form-control" required="required" placeholder="50">
              </div>
            </div>
          </div>


  			
    			
		

   				 <div class="form-group">
					<label>Catégorie *</label>
       				<select id="select" class="custom-select form-control" >

       						<?php

       					foreach ($query->fetchAll() as $value) {
       						
       						echo "<option>".$value['nom']."</option>";
       					}
	    				?>
       
	 				</select>
      			</div>
	

				<div class="form-group">
       	
	       			<label>Description du service </label>
	       			<textarea type="text" id="description"  class="form-control" placeholder="Théo le plombier.."></textarea>
	      		</div>
		


    			<i class="p-2">* Champs obligatoires</i>
   
       			<center><button onclick="createService();" class="btn mt-3 btnService btn-block">Créer un service</button></center>

       	 	</div>
		</div>
			
		</div>

	</div>


</div>




<div id="modalDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p>Etes-vous sûr de vouloir supprimer ce service ?</p>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button id="btnDelete" class="btn btn-danger" data-dismiss="modal">Supprimer</button>
      </div>
    </div>

  </div>
</div>

<div id="modalPublished" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p>Etes-vous sûr de vouloir publié ce service ?</p>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button id="btnPublish" class="btn btn-success" data-dismiss="modal">Publié</button>
      </div>
    </div>

  </div>
</div>







</section>














<script src="../js/createService.js"></script>
<?php require('footerBack.php'); ?>