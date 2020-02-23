<?php

require('functions.php');


if (!isset($_GET['id'])) {
  
  header('Location: createService.php');
}


$connect = connectDb();

$queryPrepared = $connect->prepare('SELECT s.idService, s.nom,s.prix,s.description,c.nom AS nomCateg FROM Service s, Categorie c WHERE s.idCategorie = c.idCategorie  AND s.statut = 0 AND s.idService = :id;');
$queryPrepared->execute([":id" => $_GET["id"]]);
$value = $queryPrepared->fetch(PDO::FETCH_ASSOC);

echo "<table class='table table-striped table-hover table-bordered'>";
    echo "<thead>";
      echo "<tr>";
        echo "<th scope='col'>Id</th>";   
        echo "<th>Nom</th>";    
        echo "<th>Description</th>";    
        echo "<th>Prix €</th>";    
        echo "<th>Catégorie</th>";   
        echo "<th>Action</th>";   
      echo "</tr>";   
    echo "</thead>";      
    echo "<tbody>";     
  
  
    
    echo '<tr id="tableService" >';
          echo "<th scope='row'>".$value['idService']."</th>";
          echo "<td>".$value['nom']."</td>";
          echo "<td>".$value['description']."</td>";    
          echo "<td>".$value['prix']. "</td>";    
          echo "<td>".$value['nomCateg']."</td>";   
          echo "<td>";
                echo "<button data-toggle='modal' data-target='#myModal' class='btn btn-primary' onclick='getData(".$value['idService'].")'>Modifier</button>";

          echo "</td>";
      echo "</tr>";   


  echo "</tbody>";
echo "</table>";