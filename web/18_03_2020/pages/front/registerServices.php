<?php

require "header.php";

if(!empty($_GET)){
    $id = $_GET['id'];
}else{
    $id = 0;
}

$req = $connect->prepare("SELECT nom, type FROM caracteristique WHERE idService = $id");
$req->execute(array());

$count = $req->rowCount();

if ($count == 0){
    header('Location: 404.php');
}
$_SESSION["id"] = $id;

$data= $connect->query("SELECT nom, prix FROM service WHERE idService = $id");



?>


<?php if (!empty($_SESSION['success'])){
    echo $_SESSION["success"];
}
?>

<section >
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <?php
            foreach ($data->fetchAll() as $service){
                $service['prix'] = $service['prix']/100;
                echo '<h1 class="display-4">'.$service["nom"].'</h1>';
                echo '<h5>'.$service["prix"].' €</h5>';
            }
        ?>
        <hr class="hr">
    </div>
    <form method="post" action="payment.php">
        <div class="container borderSubscription">

            <?php
                foreach ($req->fetchAll() as $caracteristique) {

                    echo '<label for="'.$caracteristique["nom"].'" class="lab area">'.$caracteristique["nom"].'</label>';
                    echo '<input name="'.$caracteristique["nom"].'" type="'.$caracteristique["type"].'" id="'.$caracteristique["nom"].'" class="form-control inputRegister" required="">';
                }
            ?>

            <input type="submit" class="btn btn-success area" value="Payer">

        </div>
    </form>
</section>



<?php
require "footer.php";
?>