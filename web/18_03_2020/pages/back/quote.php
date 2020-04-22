<?php
require "headerBack.php";
if (isset($_GET['idSouscription']) && isset($_GET['idUser'])) {

		$idSouscription = $_GET['idSouscription'];
		$idUser = $_GET['idUser'];
}else{

	header("Location: pageRequestService.php");
}




$queryVerify = $connect->prepare("SELECT s.FK_idPersonne,p.nom,p.prenom FROM souscription_service s, personne p WHERE s.idSouscriptionService = ${idSouscription} AND s.FK_idPersonne = p.idPersonne");
$queryVerify->execute();

$data = $queryVerify->fetch();

if ($data[0] != $idUser){

	header("Location: pageRequestService.php");

}



?>



<section>
	


<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-5">Devis</h1>
        <hr class="hr">
</div>



<div class="container">

		<form method="POST" action="saveQuote.php">
				
			<div class="form">
	           <div class="form-group">
	            <label>Nom *</label>
	            <input placeholder="Demande d'un coca" name="name" type="text" class="form-control" required="required">
	            </div>
	      		

	      		<p>€ Prix :</p>

	           <div class="row form-group">

	            <div class="col-md-6">
		            <label>Euros *</label>
		            <input  name="" type="number" class="form-control" required="">
		        </div>

		        <div class="col-md-6">
		            <label>Centimes</label>
		            <input name="" type="number" class="form-control">
		        </div>

	        </div>




	         <div class="form-group">
	        	
	        	  <label>Détails du devis</i></label>
		          <textarea name="informations" class="form-control" rows="5" placeholder="..."></textarea>

	        </div>


	        <button type="submit" class="btn btn-primary">Sauvegarde du devis</button>

		</form>
		
	
	</div>








</section>




































<?php
require "../footer.php";
?>