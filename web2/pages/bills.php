<?php
require("header.php");

$connect = connectDb();

$queryPrepared = $connect->prepare('SELECT s.idSouscriptionService , DATE_FORMAT(s.dateIntervention,"%d/%m/%Y %H:%m") AS dateIntervention ,p.nom ,p.prenom,serv.nom AS nomService FROM souscription_service s, personne p, service serv WHERE s.FK_idService = serv.idService AND  s.FK_idPersonne = p.idPersonne AND s.statutReservation = 2');
$queryPrepared->execute();

$data = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


?>


<section class="container pt-4">
	
<div class="title text-center pt-1 pb-3">

	<h1>Factures</h1>
	<hr class="hr">
</div>


<table class='table table-striped table-hover table-bordered'>
	
	<thead>
		<tr>
			
			<th scope="col">Id</th>
			<th>Date</th>
			<th>Service</th>
			<th>Client</th>
			<th>Prestataire</th>
			<th>Facture</th>
		</tr>
	</thead>
	<tbody>
	</tbody>


	<?php

		foreach ($data as $value) {
		
		
			echo '<tr id="\'' . $value["idSouscriptionService"] . '\'" >';
			
				echo "<td>".$value['idSouscriptionService']."</td>";
				echo "<td>".$value['dateIntervention']."</td>";
				echo "<td>".$value['nomService']."</td>";
				
				echo "<td>".$value['prenom'] . " " . $value['nom']."</td>";
				echo "<td>".$value['dateIntervention']."</td>";
				echo '<td>

						<a href="createBills.php?id=\''. $value["idSouscriptionService"] .'\'" class="btn btn-success">PDF</button>
					</td>';
			
				
			echo "</tr>";
		}
	?>





</table>





</section>