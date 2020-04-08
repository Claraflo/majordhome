<?php
require "header.php";

if (!empty($_GET)) {
    $id = $_GET['id'];
} else {
    $id = 0;
}
$id = $_GET['id'];
$_SESSION['idPayment'] = $id;

$countEnd = 0;

$req = $connect->prepare("SELECT dateReservation FROM souscription_service WHERE idSouscriptionService = ".$id." AND FK_idPersonne =".$_SESSION['user']['idPersonne']);
$req->execute(array());
$service = $req->fetch();

$count = $req->rowCount();

if ($count == 0) {
    $req = $connect->prepare("SELECT dateAchat FROM souscription_abonnement WHERE idSouscriptionAbonnement = ".$id." AND FK_idPersonne =".$_SESSION['user']['idPersonne']);
    $req->execute(array());
    $service = $req->fetch();

    $countEnd = $req->rowCount();
}

if ($countEnd == 0 && $count == 0) {
    header('Location: ../../404.php');
}


$data = $connect->prepare("SELECT versement.statut FROM versement, facture WHERE (facture.FK_idSouscriptionService = " . $id . " OR facture.FK_idSouscriptionAbonnement = " . $id . ") AND versement.FK_idFacture = facture.idFacture");
$data->execute(array());
$payment = $data->fetchAll(PDO::FETCH_ASSOC);

$countPayment = $data->rowCount();

?>


<section>
    <div class="container">
        <div class="form">
            <form id="form-payement" method="post" action="payment.php">
                <h3 class="text-center title">Choix du remboursement</h3>
                <hr class="hr">

                <div class="form-group">
                    <label for="number">Payer le:</label>
                    <select name="number" class="form-control" id="number">
                        <?php
                        $i = 1;
                        $countFirst = 0;
                        foreach ($payment as $value) {
                            if ($value['statut'] == 0 && $countFirst == 0) {
                                echo '<option value="' . $i . '">' . $i . ' ème remboursement</option>';
                                $countFirst = 1;
                            } else if ($value['statut'] == 0 && $countFirst == 1) {
                                echo '<option value="' . $i . '">' . $i . ' ème remboursement et les précédents</option>';
                            }

                            {
                            }
                            $i++;
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

