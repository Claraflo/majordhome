<?php
require('functions.php');

if(isset($_GET['id'])) {


  $connect = connectDb();

  $stmt = $connect->prepare('DELETE FROM Categorie WHERE idCategorie = ?');
  $res = $stmt->execute([
      $_GET['id']
    ]);
   
}


