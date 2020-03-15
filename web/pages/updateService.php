<?php
require('functions.php');


if (!isset($_GET['id'])) {
	
	header('Location: createService.php');
}


$connect = connectDb();


$query = $connect->query('SELECT nom FROM Categorie;');
$query->execute();


$queryPrepared = $connect->prepare('SELECT c.nom,c.type FROM Caracteristique c, Service s WHERE c.idService = s.idService AND c.idService = :id ');
		
		$queryPrepared->execute([

					":id"=>$_GET['id']
				

				]);

	$array = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


		



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
<body onload="init(<?php echo $_GET['id'] ?>);">

<?php require('headerBack.php'); ?>

<section>


<div id="information"></div>

<div class="title text-center pt-4">
	<h1>Gestion des services</h1>
	<hr class="hr">
</div>



<div class="container pt-4">

	
	<h4>Mon service</h4>
	<hr>

<div id="table" class="pb-4"></div>


<h4>Mon formulaire </h4>
<hr>


<div class="row">

		<div class="col-md-4">

			<div class="form-group">
       			<label>Nom du champ  </label>
       			<input id='name' type="text" class="form-control" placeholder="Nom">
      		</div>
			
		
			<div class="form-group">

				<label>Type du champ  </label>
	  			<select id='select2' class="custom-select form-control" >
	    			<option>Texte</option>
	    			<option>Date</option>
	    			<option>Nombre</option>
	    			
	 			</select>
			</div>


			<button onclick='addFeature(<?php echo $_GET['id'] ?>)' class="btn btn-success">Ajouter <i class='fas fa-plus'></i></button>
		</div>




		<div class="col-md-8 form" id="form"></div>
	</div>


</div>









</section>






<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       
        <!-- <h4 class="modal-title">Modification</h4> -->
        <i class='fas fa-2x fa-edit'></i>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
       <div class="form-group">
       	
       	<label>Nom *</label>
       	<input type="text" id="updateName" class="form-control" required="required" placeholder="Voyage">
       </div>

        <div class="form-group">
       	
       	<label>Description</label>
       	<textarea type="text" id="updateDescription" class="form-control" placeholder="Voyage ..."></textarea>

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
       	
       	<label>Catégorie</label>
     	<select id="select" class="custom-select form-control" >

       <?php

       	foreach ($query->fetchAll() as $value) {
       						
       		echo "<option>".$value['nom']."</option>";
       	}
	    ?>
       
	 	</select>

       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
       	<button id="update" data-dismiss="modal" class="btn btn-primary">Modifier</button>
      </div>
    </div>

  </div>
</div>













<script src="../js/updateService.js"></script>
<?php require('footerBack.php'); ?>