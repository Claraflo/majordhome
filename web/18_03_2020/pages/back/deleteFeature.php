<?php
require('../functions.php');

if(isset($_GET['id'])) {


  $connect = connectDb();

  $stmt = $connect->prepare('DELETE FROM Caracteristique WHERE idCaracteristique = ?');
  $stmt->execute([
      $_GET['id']
    ]);
   
}