<?php 
session_start(); 
require('functions.php');

updateMsgAutomatic();




?>
<!DOCTYPE html>
<html>
<head>
	<title>Boîte de réception</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/messagesBack.css">
	<link rel="stylesheet" type="text/css" href="../css/headerBack.css">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">



	<!-- Lien Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Lien police d'écriture -->
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

  <!-- Lien Icon -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

</head>
<body>

<?php require('headerBack.php'); ?>


<section class="container pt-4">


	<div id="info"></div>

 <?php 

 	if(!empty($_SESSION["sendSuccess"])){
        echo "<div class='alert alert-success'>";
        foreach ($_SESSION["sendSuccess"] as $success) {
            echo "<li>".$success;
        }
        echo "</div>";
        unset($_SESSION["sendSuccess"]);
    }


    if(!empty($_SESSION["errorsMessage"])){
        echo "<div class='alert alert-danger'>";
        foreach ($_SESSION["errorsMessage"] as $error) {
            echo "<li>".$error;
        }
        echo "</div>";
        unset($_SESSION["errorsMessage"]);
    }


?>


<div class="title text-center pt-1 pb-3">
	<h1>Centre de messagerie</h1>
	<hr class="hr">
	
</div>

	<div class="row block">
		<aside class="col-md-3">

			<div class="headerAside">
				
				<h6>W.NASSURALLY</h6>
				<p>waseem11@hotmail.fr</p>
			</div>

			<div class="p-4">
			<button class="btn btn-primary btn-block" data-toggle='modal' data-target='#message'>Nouveau message <i class="far fa-1x fa-envelope"></i></button>
			</div>

			<div id="message" class="modal fade" role="dialog">
  				<div class="modal-dialog">

  
   					 <div class="modal-content">
					      <div class="modal-header">
					      	 <h4 class="modal-title">Nouveau message <i class="far fa-1x fa-envelope"></i></h4>
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					      </div>


					      <form method="POST" action="createMessage.php">
					      <div class="modal-body">
					      	
					      	<div class="form-group">
                                <label>Destinataire *</label>
                                <input type="email" placeholder="" name="to" class="form-control" required="required"> 
                            </div>

                            <div class="form-group">
                                <label>Titre *</label>
                                <input type="text" placeholder="" name="title" class="form-control" required="required"> 
                            </div>

                            <div class="form-group">
                                <label>Message *</label>
                               	<textarea class="form-control" name="message" rows="10" cols="30" required="required"></textarea>
                            </div>
                          
                        
					      </div>
					      <div class="modal-footer">
					      	<button type="button" class="btn btn-danger" data-dismiss="modal">Ignorer <i class="fas fa-trash"></i></button>
       						<button id="update" type="submit" class="btn btn-primary" >Envoyer <i class="fas fa-paper-plane"></i></button>
					      </div>

					        </form>
					    </div>

					  </div>
					</div>


			<ul class="ulMessage">


			
				<a href="messagesBack.php"><li class="liMessage bg"><i class="fas fa-inbox"></i> Boîte de réception</li></a>
				<a href="sendMessage.php"><li class="liMessage "><i class="fas fa-paper-plane"></i> Messages envoyés</li></a>
				<a href="pageArchiveMessage.php"><li class="liMessage"><i class="fas fa-archive"></i> Messages archivés</li></a>
				<a href="pageDeleteMessage.php"><li class="liMessage"><i class="fas fa-trash"></i> Corbeille</li></a>
			</ul>
		</aside>

		<div class="col-md-9 p-0">

			<div class="headInbox">
				
				<h6>Boîte de réception</h6>
			</div>


		<div class="p-3">

				<i id="btn1" onclick="test()" class="fas fa-tasks btn btn-primary m-2"></i>

				<i hidden="true" id="btn2" class="btn btn-danger fas fa-times m-2" onclick="window.location.reload()"></i>
				<i hidden="true" id="btn" class="btn btn-danger fas fa-trash m-2" onclick="deleteAllArchiveMessage()"></i>
	
				<div id="tab"></div>
			</div>

		</div>
		



	</div>
	

</section>



<script src="../js/messagesBack.js"></script>


<?php require('footerBack.php'); ?>