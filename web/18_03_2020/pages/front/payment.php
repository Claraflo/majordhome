<?php
require "header.php";

if (!isset($_POST['number']) || !isset($_SESSION['idPayment']) || !isset($_SESSION['idFacturePayment'])){
    header('Location: history.php');
}
$idPayment = $_SESSION['idPayment'];
$idFacturePayment = $_SESSION['idFacturePayment'];
$number = $_POST['number'];

unset($_SESSION['idPayment']);
unset($_SESSION['idFacturePayment']);


$numberPayment = explode('.', $number);

for ($i = 0; $i < count($numberPayment); $i++) {
    $req = $connect->prepare("SELECT somme, facture.FK_idPersonne FROM versement, facture WHERE idVersement = ".$numberPayment[$i]);
    $req->execute(array());
    $versement = $req->fetch();
    if (empty($versement) || $versement['FK_idPersonne'] != $_SESSION['user']['idPersonne'] || $versement['somme'] != 0){
        header('Location: history.php');
    }
}



$req = $connect->prepare("SELECT somme FROM versement WHERE FK_idFacture = ".$idFacturePayment." AND statut = 1");
$req->execute(array());
$somme = $req->fetch();
$count = $req->rowCount();

if ($count == 1){
    echo $somme['somme'];
}else if ($count == 0){
    header('Location: history.php');
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

