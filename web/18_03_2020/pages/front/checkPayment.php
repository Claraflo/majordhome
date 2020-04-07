<?php
require "header.php";

if(!empty($_GET)){
    $id = $_GET['id'];
}else{
    $id = 0;
}


$id = '1dxyzfOzg8';


$req = $connect->prepare("SELECT dateReservation FROM souscription_service WHERE idSouscriptionService = $id");
$req->execute(array());
$subscription = $req->fetch();

$count = $req->rowCount();

if ($count == 0){
    header('Location: ../../404.php');
}


$_SESSION['dateTime'] = $subscription['annee'].':'.$subscription['mois'].':'.$subscription['jours'];
$_SESSION['idSubscription'] = $id;

$price = $subscription['prix'];
$subscription['prix'] = $subscription['prix']/100;




?>



<section>
    <div class="container">
        <div class="form">
            <form id="form-payement" method="post" action="paymentSubscription.php">
                <h3 class="text-center title"><?php echo $subscription['nom']?></h3>
                <h2 class="card-title pricing-card-title"><?php echo $subscription['prix'] ?>€ TTC</h2>
                <hr class="hr">

                <div class="form-group">
                    <label for="number">Payer en:</label>
                    <select name="number" class="form-control" id="number">
                        <option value="1">1 fois</option>
                        <option value="2">2 fois</option>
                        <option value="4">4 fois</option>
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

