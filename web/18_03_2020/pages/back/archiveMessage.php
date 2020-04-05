<?php
require('../functions.php');

if(isset($_GET['id'])) {


  $connect = connectDb();

  $stmt = $connect->prepare('UPDATE Messagerie SET statutSource = 2 WHERE idMessagerie = ?');
  $res = $stmt->execute([
      $_GET['id']
    ]);
   
}