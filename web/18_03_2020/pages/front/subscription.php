<?php
require "header.php";

if (!empty($_SESSION['success'])){
    echo $_SESSION["success"];
}
?>

<section >
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Abonnements</h1>
        <hr class="hr">
    </div>
    <form method="post">
    <div class="container borderSubscription">
        <div class="row text-center">
            <?php
            $data = $connect->query("SELECT idAbonnement, nom, prix, description, semaine, temps, debutTemps, finTemps FROM abonnement WHERE statut=0");
            foreach ($data->fetchAll() as $key => $subscription) {

                    $subscription['prix'] = $subscription['prix']/100;

                    echo '<div class="col-md-4">';
                        echo '<div class="card shadow-sm">';
                            echo '<div class="card-header">';
                                echo '<h4 class="my-0 font-weight-normal">'.$subscription['nom'].'</h4>';
                            echo "</div>";
                            echo '<div class="card-body">';
                                echo '<h2 class="card-title pricing-card-title">'.$subscription['prix'].'€ TTC <small class="text-muted">/ an</small></h2>';
                                echo '<ul class="list-unstyled mt-3 mb-4">';
                                    echo "<li class='liSubscription'>Bénéficiez d'un accès privilégié en illimité ".$subscription['semaine']."j/7, ".$subscription['debutTemps']."h/h".$subscription['finTemps'];
                                    echo '<li class="liSubscription">'.$subscription['description'];
                                    echo '<li class="liSubscription">'.$subscription['temps'].'h de services/mois';
                                echo '</ul>';
                                echo '<a class="btnSubscription" href="paymentSubscription.php?id='.$subscription['idAbonnement'].'">Payer</a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
    </form>
</section>


<?php
require "../footer.php";
?>