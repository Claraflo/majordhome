<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Clients</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/customer.css">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Lien Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Lien police d'écriture -->
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

  <!-- Lien Icon -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark" id="nav">
        <div class="container">
            <a class="navbar-brand active" href="index.php" title="">
                <img class="logo" src="../img/majordhome.png" title="logo" alt="Logo Majord'home">
            </a>
        </div>
    </nav>
</header>

<?php if(!empty($_SESSION["confirmFormAuth"])){
    echo "<div class='alert alert-success'>";
    foreach ($_SESSION["confirmFormAuth"] as $confirm) {
        echo "<li>".$confirm;
    }
    echo "</div>";
    unset($_SESSION["confirmFormAuth"]);
}


if (!empty($_SESSION["delete"])) {
    echo "<div class='alert alert-danger'>";
    foreach ($_SESSION["delete"] as $delete) {
        echo "<li>" . $delete;
    }
    echo "</div>";
    unset($_SESSION["delete"]);
}

?>


<section >
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Clients</h1>
        <hr class="hr">
    </div>
    <div class="borderCustomer">
        <a class="btn btn-success" id="add" href="createCustomer.php">Ajouter un client</a>
        <div class="container">
            <table class="table-hover table-bordered">
                <thead>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date de naissance</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Code postal</th>
                    <th>Téléphone</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </thead>
                <tbody id="customer">
                </tbody>
            </table>
        </div>
    </div>
</section>



<div id="content-delete" class="content-delete">
    <div class="delete">
        <span class="cross">&times;</span>
        <p>Voulez-vous vraiment supprimer ce client ?</p>
        <button class="btn btn-primary" id="no">Non</button>
        <button class="btn btn-danger" id="yes">Oui</button>
    </div>
</div>


<footer>

    <p class="text-center pt-4">Copyright © Majord'home 2020</p>

</footer>


<script src="../js/customer.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>