<?php
require('header.php');
?>

<section>
	

	 <?php 

      if(!empty($_SESSION["updateSuccess"])){
            echo "<div class='alert alert-success'>";
              
                echo "<li>".$_SESSION['updateSuccess'];
                  
                    echo "</div>";
            unset($_SESSION["updateSuccess"]);
            }

   ?>

	 <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-5">Mon compte</h1>
        <hr class="hr">
    </div>



<div class="container borderSubscription">

	<form method="POST" action="updateAccount.php" >
    <div class="row">

     	<div class="col-md-6">
           
	        <div class="form-group">
	            <label for="">Nom *</label>
	            <input name="lastName" type="text" id="" class="form-control" value="<?php echo $_SESSION['user']['nom'] ?>" required="required">
	        </div>
	    </div>

       <div class="col-md-6">
           
	        <div class="form-group">
	            <label for="firstName">Prénom *</label>
	            <input name="firstName" type="text" id="" class="form-control" value="<?php echo $_SESSION['user']['prenom'] ?>" required="required">
	        </div>
	    </div>

	    <div class="col-md-12">
           
	        <div class="form-group">
	            <label for="">Email *</label>
	            <input name="email" type="email" id="" class="form-control" value="<?php echo $_SESSION['user']['mail'] ?>" required="required">
	        </div>
	    </div>

	    <div class="col-md-6">
           
	        <div class="form-group">
	            <label for="">Date de naissance *</label>
	            <input name="date" type="date" id="" class="form-control" value="<?php echo $_SESSION['user']['dateNaissance'] ?>" required="required">
	        </div>
	    </div>

	     <div class="col-md-6">
           
	        <div class="form-group">
	            <label for="">Téléphone *</label>
	            <input name="phone" type="text" id="" class="form-control" value="<?php echo $_SESSION['user']['telephone'] ?>"required="required">
	        </div>
	    </div>

	     <div class="col-md-12">
           
	        <div class="form-group">
	            <label for="">Adresse *</label>
	            <input name="address" type="text" id="" class="form-control" value="<?php echo $_SESSION['user']['adresse'] ?>" required="required">
	        </div>
	    </div>


	    <div class="col-md-6">
           
	        <div class="form-group">
	            <label for="">Ville *</label>
	            <input name="city" type="text" id="" class="form-control" value="<?php echo $_SESSION['user']['ville'] ?>" required="required">
	        </div>
	    </div>

	     <div class="col-md-6">
           
	        <div class="form-group">
	            <label for="">Code postal *</label>
	            <input name="code" type="text" id="" class="form-control" value="<?php echo $_SESSION['user']['codePostal'] ?>" required="required">
	        </div>
	    </div>

        
    </div>
            
      	<input type="submit" class="btn btn-success area" value="Modifier mon compte">


      </form>

</div>



</section>






































<?php
require "../footer.php";
?>