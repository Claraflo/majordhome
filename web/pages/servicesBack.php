<?php
require('functions.php');
session_start();
$connect = connectDb();

$query = $connect->query('SELECT nom FROM Categorie;');
$query->execute();

$queryPrepared = $connect->prepare('SELECT s.idService,s.nom,s.prix,s.description,c.nom AS nomCateg FROM Service s, Categorie c WHERE s.idCategorie = c.idCategorie  AND s.statut = 1;');

$queryPrepared->execute();
$dataService = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);




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

<div class="title text-center pt-4">
	<h1>Gestion des services</h1>
	<hr class="hr">
</div>

<div class="container pt-5">

	
	<button class="btn btnService"><i class="fas fa-eye"> </i> Liste des services non publié</button>
	<a href="createService.php"><button class="btn btnService"> <i class="fas fa-plus"> </i> Créer un nouveau service</button></a>
	<hr>

</div>

<div class="container pt-3">
	<div class="row">
		<div class="col-md-12">
			<div>
				<h4>Liste des services publié</h4>
				<hr>
			</div>

			<div id="table">
				
				<table class='table table-striped table-hover table-bordered'>
					<thead>
				   		<tr>
				     		<th scope='col'>Id</th>		
				     		<th>Nom</th>		
				     		<th>Description</th>		
				     		<th>Prix €</th>		
				     		<th>Catégorie</th>		
				     		<th>Action</th>		
		     			</tr>		
		    		</thead>			
		    		<tbody>	
		    		<?php	

		    		foreach ($dataService as $value) {

		    		echo '<tr id="category-' . $value['idService'] .'">';
      					echo "<th scope='row'>".$value['idService']."</th>";
      					echo "<td>".$value['nom']."</td>";
      					echo "<td>".$value['description']."</td>";		
      					echo "<td>".$value['prix']."</td>";		
      					echo "<td>".$value['nomCateg']."</td>";		
      					echo "<td>";

      							echo "<button class='btn btn-primary' >Ne pas publié</button>";
      						
      					echo "</td>";
    				echo "</tr>";
    				}		

		    		?>
		    	</tbody>
		    </table>
			</div>

		</div>


</section>





<script src="../js/servicesBack.js"></script>
<?php require('footerBack.php'); ?>