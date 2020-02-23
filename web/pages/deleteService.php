<?php
require('functions.php');

if(isset($_GET['id'])) {


  $connect = connectDb();

  $stmt = $connect->prepare('DELETE FROM Service WHERE idService = ?');
  $res = $stmt->execute([
      $_GET['id']
    ]);
   
}


