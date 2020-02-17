<!DOCTYPE html>
<html>
<head>
	<title>Catégorie</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/category.css">
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


<div class="title text-center pt-5">
	<h1>Gestion des catégories</h1>
	<hr class="hr">
</div>

<div class="container pt-4">
	
	<div class="row">
		
		<div class="col-md-6">
			
			<div class="title pb-4">
				
				<h4>Liste des catégories</h4>
				
			</div>

			<div id="table"></div>
	<!-- 		<table class="table table-striped table-hover table-bordered">
  				<thead>
   					<tr>
     					<th scope="col">Id</th>
     					<th scope="col">Nom</th>
     					<th scope="col">description</th>
     					<th scope="col">Action</th>
    				</tr>
  				</thead>
 				<tbody>
    				<tr>
      					<th scope="row">1</th>
      					<td>Mark</td>
      					<td>Otto</td>
      					<td>
      						<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
      						<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
      					</td>
     				
    				</tr>
    				
  
   
  				</tbody>
			</table> -->

		</div>
		<div class="col-md-6">
			

			<div class="form">

			<div class="title pb-3">
		
				<h4>Créer une catégorie</h4>
				
			</div>

			 
    	<!-- 	<form> -->
   
    

        <div class="form-group">
            <label for="inputEmail">Nom *</label>
            <input name="name" type="text" id="name" class="form-control" placeholder="Voyage" required="required">
        </div>

        <div class="form-group">
            <label for="pwd">Description </label>
            <textarea name="description"  id="description" class="form-control" placeholder="Voyage "></textarea>
        </div>

   

    <i class="p-2">* Champs obligatoires</i>
   
        <center><button class="btn mt-3 btnCategory btn-block" onclick="createCategory();">Créer une catégorie</button></center>

        </div>
   <!--  </form> -->
    </div>
		</div>

	</div>


</div>

</section>

















<script src="../js/category.js"></script>
<?php require('footerBack.php'); ?>