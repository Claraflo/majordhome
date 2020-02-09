<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/subscription.css">
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


<section >
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Abonnements</h1>
    </div>
    <div class="container borderSubscription">
        <div class="card-deck mb-3 text-center">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Abonnement de base</h4>
                </div>
                <div class="card-body">
                    <h2 class="card-title pricing-card-title">2400€ TTC <small class="text-muted">/ an</small></h2>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li class="liSubscription">Bénéficiez d'un accès privilégié en illimité 5j/7 de 9h à 20h
                        <li class="liSubscription">Demandes illimitées de renseignements
                        <li class="liSubscription">12h de services / mois
                    </ul>
                    <button type="button" class="btnSubscription">Choisir</button>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Abonnement Familial</h4>
                </div>
                <div class="card-body">
                    <h2 class="card-title pricing-card-title">3600€ TTC <small class="text-muted">/ an</small></h2>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li class="liSubscription">Bénéficiez d'un accès privilégié en illimité 6j/7 de 9h à 20h
                        <li class="liSubscription">Demandes illimitées de renseignements
                        <li class="liSubscription">25h de services / mois
                    </ul>
                    <button type="button" class="btnSubscription">Choisir</button>
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Abonnement Prenium</h4>
                </div>
                <div class="card-body">
                    <h2 class="card-title pricing-card-title">6000€ TTC <small class="text-muted">/ an</small></h2>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li class="liSubscription">Bénéficiez d'un accès privilégié en illimité 7j/7 24h/24
                        <li class="liSubscription">Demandes illimitées de renseignements
                        <li class="liSubscription">50h de services / mois
                    </ul>
                    <button type="button" class="btnSubscription">Choisir</button>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>

    <p class="text-center pt-4">Copyright © Majord'home 2020</p>

</footer>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>