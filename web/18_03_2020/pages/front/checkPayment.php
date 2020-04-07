<?php
require "header.php";

if(!empty($_GET)){
    $id = $_GET['id'];
}else{
    $id = 0;
}
$id = $_GET['id'];


$countEnd = 0;

$req = $connect->prepare("SELECT dateReservation FROM souscription_service WHERE idSouscriptionService = $id");
$req->execute(array());
$service = $req->fetch();

$count = $req->rowCount();

if ($count == 0){
    $req = $connect->prepare("SELECT dateAchat FROM souscription_abonnement WHERE idSouscriptionAbonnement = $id");
    $req->execute(array());
    $service = $req->fetch();

    $countEnd = $req->rowCount();
}

if($countEnd == 0 && $count == 0) {
   header('Location: ../../404.php');
}

$data = $connect->prepare("SELECT nombreEcheance FROM facture WHERE FK_idSouscriptionService = $id");
$data->execute(array());
$invoice = $data->fetch();

if ($invoice['nombreEcheance'] == 1){
    header('Location: services.php');
}

?>



<section>
    <div class="container">
        <div class="form">
            <form id="form-payement" method="post" action="payment.php">
                <h3 class="text-center title">Choix du remboursement</h3>
                <hr class="hr">

                <div class="form-group">
                    <label for="number">Remboursement:</label>
                    <select name="number" class="form-control" id="number">
                        <?php
                            for ($i = 2; $i < $invoice['nombreEcheance']+1; $i++ ) {
                                if ($i == 2) {
                                    echo '<option value="' . $i . '">' . $i . ' ème remboursement</option>';
                                }else if ($i == $invoice['nombreEcheance']){
                                    echo '<option value="' . $i . '">Tout rembourser</option>';
                                }else{
                                    echo '<option value="' . $i . '">Payer jusqu\'au ' . $i . ' ème remboursement</option>';
                                }
                            }
                        ?>
                    </select>
                </div>

                <input type="submit" class="btn btn-success area" value="Payer">
            </form>

        </div>

    </div>

</section>


<?php
require "../footer.php";
?>

