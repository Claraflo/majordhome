<?php
require('functions.php');

if(isset($_GET['array']) && !empty($_GET['array'])) {

$array = [];

array_push($array, $_GET['array']);

$connect = connectDb();

  	
  	foreach ($array as $value) {
		
		$stmt = $connect->prepare('UPDATE Messagerie SET statutSource = 1 WHERE idMessage = ?');
  		$res = $stmt->execute([
   				$value
     ]);
  	 } 

}


