<?php
require "header.php";

$id = $_SESSION['id'];
unset($_SESSION['id']);

$req = $connect->prepare("SELECT nom, prix FROM service WHERE idService = $id");
$req->execute(array());
$service = $req->fetch();

$count = $req->rowCount();

if ($count == 0){
    header('Location: 404.php');
}

$price = $service['prix'];
require ('../../stripe-php-master/init.php');

\Stripe\Stripe::setApiKey('sk_test_KIoaPZUhWtezXMfycCQWaVP300pmT5edj0');

$intent = \Stripe\PaymentIntent::create([
    'amount'=> $price,
    'currency' => 'eur',
    'statement_descriptor' => 'Majordhome',
    'description' => $service['nom'],
    'payment_method_types' => ['card'],
    'setup_future_usage' => 'off_session',
]);


$price = $price/100;


?>

<section>
    <div class="container">
        <div class="form">
            <form id="form-payement">
                <h3 class="text-center title"><?php echo $service['nom']?></h3>
                <h2 class="card-title pricing-card-title"><?php echo $price ?>€ </h2>
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

