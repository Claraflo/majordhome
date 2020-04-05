<?php
require('../functions.php');

$connect = connectDb();

//$query = $connect->query('SELECT idServices,nom,description,prix FROM Service;');
//$query->execute();



echo "<table class='table table-striped table-hover table-bordered'>";
  	echo "<thead>";
   		echo "<tr>";
     		echo "<th scope='col'>Id</th>";		
     		echo "<th>Nom</th>";		
        echo "<th>Prix</th>";   
        echo "<th>Catégorie</th>";    
     		echo "<th>Action</th>";		
     	echo "</tr>";		
    echo "</thead>";			
    echo "<tbody>";			
  
  	//foreach ($query->fetchAll() as $value) {
		
	// 	echo '<tr id="category-' . $value['idService'] .'">';
 //      		echo "<th scope='row'>".$value['idService']."</th>";
 //      		echo "<td>".$value['nom']."</td>";
 //          echo "<td>".$value['description']."</td>";    
 //          echo "<td>".$value['prix']."</td>";   
 //      		echo "<td>".$value['prix']."</td>";		
 //      		echo "<td>";
 //      			echo "<button onclick='getData(".$value['idService'].");' type='button' data-toggle='modal' data-target='#myModal' class='btn btn-primary m-1'><i class='fas fa-edit'></i></button>";
 //      			echo "<button onclick='deleteConfirm(".$value['idService'].");'  data-toggle='modal' data-target='#modalDelete' class='btn btn-danger m-1'><i class='fas fa-trash-alt'></i></button>";				
 //      		echo "</td>";
 //    	echo "</tr>";		
	// }


	echo "</tbody>";
echo "</table>";