<?php

require "headerBack.php";

if (!isset($_SESSION['idCustomer'])){
    header('Location: customer.php');
}


if(!empty($_GET)){
    $id = $_GET['id'];
}else{
    $id = 0;
}

$data = $connect->prepare("SELECT idSouscriptionService, FK_idService FROM souscription_service WHERE idSouscriptionService = '".$id."'");
$data->execute(array());

$count = $data->rowCount();
$souscription = $data->fetch();

if ($count == 0){
    header('Location: ../../404.php');
}


$req = $connect->prepare("SELECT idCaracteristique, nom, type FROM caracteristique WHERE idService = ".$souscription['FK_idService']);
$req->execute(array());

$result = $connect->prepare("SELECT idSouscriptionService, FK_idService FROM donnees_service WHERE FK_idSouscriptionService = '".$id."'");
$result->execute(array());
$value = $result->fetch();

$idCaracteristique = [];
?>

<section >
    <form method="post" action="saveServiceBack.php">
        <div class="container borderSubscription">
            <label for="intervention" class="lab area">Date de l'intervention</label>
            <input name="intervention" type="date"id="intervention" class="form-control inputRegister" required="">

            <label for="time" class="lab area">Durée</label>
            <input name="time" type="time"id="time" class="form-control inputRegister" required="">
            <?php
            foreach ($req->fetchAll() as $caracteristique) {
                $idCaracteristique[] = $caracteristique['idCaracteristique'];
                echo '<label for="'.$caracteristique["nom"].'" class="lab area">'.$caracteristique["nom"].'</label>';
                echo '<input name="'.$caracteristique["nom"].'" type="'.$caracteristique["type"].'" id="'.$caracteristique["nom"].'" class="form-control inputRegister" required="">';
            }
            $_SESSION['idCaracteristique'] = $idCaracteristique;
            ?>

            <div class="form-group">
                <label for="number">Payer en:</label>
                <select name="number" class="form-control" id="number">
                    <option value="1">1 fois</option>
                    <option value="2">2 fois</option>
                    <option value="4">4 fois</option>
                </select>
            </div>

            <input type="submit" class="btn btn-success area" value="Valider l'enregistrement">

        </div>
    </form>
</section>



<?php
require "../footer.php";
?>