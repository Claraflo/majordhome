<?php
session_start();

$id = $_SESSION['id'];

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}

$req = $bdd->prepare("SELECT nom, prix FROM service WHERE idService = $id");
$req->execute(array());
$service = $req->fetch();

$count = $req->rowCount();

if ($count == 0){
    header('Location: error.php');
}

$price = $service['prix'];
require ('../stripe-php-master/init.php');

\Stripe\Stripe::setApiKey('sk_test_KIoaPZUhWtezXMfycCQWaVP300pmT5edj0');

$intent = \Stripe\PaymentIntent::create([
    'amount'=> $price,
    'currency' => 'eur',
    'statement_descriptor' => 'Majordhome',
    'description' => $service['nom'],
    'payment_method_types' => ['card'],
    'setup_future_usage' => 'off_session',
]);





?>

<!DOCTYPE html>
<html>
<head>
    <title>Paiement</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/payment.css">
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


<section>
    <div class="container">
        <div class="form">
            <form id="form-payement">
                <h3 class="text-center title"><?php echo $service['nom']?></h3>
                <h2 class="card-title pricing-card-title"><?php echo $service['prix'] ?>€ </h2>
                <hr class="hr">

                <label for="cardholder-name">Nom du titulaire de la carte *</label>
                <input id="cardholder-name" class="form-control inputPayement" type="text" placeholder="Dufour" required="">

                <div id="card-element" class="form-control"></div>
                <button id="card-button" class="btnPayement" data-secret="<?= $intent->client_secret ?>">Payer</button>
            </form>
        </div>
    </div>
</section>

<footer>

    <p class="text-center pt-4">Copyright © Majord'home 2020</p>

</footer>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/payment.js"></script>


</body>
</html>