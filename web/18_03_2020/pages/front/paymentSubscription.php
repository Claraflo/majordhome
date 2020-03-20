<?php
require "header.php";

if(!empty($_GET)){
    $id = $_GET['id'];
}else{
    $id = 0;
}


$req = $connect->prepare("SELECT nom, prix, annee, mois, jours FROM abonnement WHERE idAbonnement = $id");
$req->execute(array());
$subscription = $req->fetch();

$count = $req->rowCount();

if ($count == 0){
    header('Location: ../../404.php');
}


$_SESSION['dateTime'] = $subscription['annee'].':'.$subscription['mois'].':'.$subscription['jours'];
$_SESSION['idSubscription'] = $id;

$price = $subscription['prix'];
require ('../../stripe-php-master/init.php');

\Stripe\Stripe::setApiKey('sk_test_KIoaPZUhWtezXMfycCQWaVP300pmT5edj0');

$intent = \Stripe\PaymentIntent::create([
    'amount'=> $price,
    'currency' => 'eur',
    'statement_descriptor' => 'Majordhome',
    'description' => $subscription['nom'],
    'payment_method_types' => ['card'],
    'setup_future_usage' => 'off_session',
]);


$subscription['prix'] = $subscription['prix']/100;




?>



<section>
    <div class="container">
        <div class="form">
            <form id="form-payement">
                <h3 class="text-center title"><?php echo $subscription['nom']?></h3>
                <h2 class="card-title pricing-card-title"><?php echo $subscription['prix'] ?>€ TTC <small class="text-muted">/ an</small></h2>
                <hr class="hr">

                <label for="cardholder-name">Nom du titulaire de la carte *</label>
                <input id="cardholder-name" class="form-control inputPayement" type="text" placeholder="Dufour" required="">

                <div id="card-element" class="form-control"></div>
                <button id="card-button" class="btnPayement" data-secret="<?= $intent->client_secret ?>">Payer</button>
            </form>
        </div>
    </div>
</section>


<script src="https://js.stripe.com/v3/"></script>
<script src="../../js/paymentSubscription.js"></script>

<?php
require "../footer.php";
?>

