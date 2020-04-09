<?php
require "header.php";

if (!isset($_POST['number']) || !isset($_SESSION['idPayment'])){
    header('Location: history.php');
}
$idPayment = $_SESSION['idPayment'];
$number = $_POST['number'];

//if ($number < 1 || $number > 4){
//    header('Location: history.php');
//}

echo 'number = '.$number;
echo '<br>';

$test = explode('.', $number);

echo count($test);
//echo $test[0];

$req = $connect->prepare("SELECT sommeRestante FROM facture WHERE (FK_idSouscriptionService = ".$idPayment." OR FK_idSouscriptionAbonnement =".$idPayment.") AND FK_idPersonne =".$_SESSION['user']['idPersonne']);
$req->execute(array());
$service = $req->fetch();
//echo $service['sommeRestante'];
$count = $req->rowCount();

if($count == 0) {
    header('Location: ../../404.php');
}

$data = $connect->prepare("SELECT versement.statut FROM versement, facture WHERE (facture.FK_idSouscriptionService = " . $id . " OR facture.FK_idSouscriptionAbonnement = " . $id . ") AND versement.FK_idFacture = facture.idFacture AND facture.FK_idPersonne =".$_SESSION['user']['idPersonne']);
$data->execute(array());
$payment = $data->fetchAll(PDO::FETCH_ASSOC);

foreach ($payment as $value) {
  // echo $value['statut'];
}


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







?>



<section>
    <div class="container">
        <div class="form">
            <form id="form-payement">
                <h3 class="text-center title">Remboursement</h3>
                <h2 class="card-title pricing-card-title"><?php echo $price ?>€ TTC
                    <small class="text-muted">
                        <?php if($number == 2){ echo "/mois pendant 2 mois à compter d'aujourd'hui";}
                        else if ($number == 4){ echo "/mois pendant 4 mois à compter d'aujourd'hui";}
                        ?>
                    </small>
                </h2>
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

