<?php
session_start ();

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}

$data = $bdd->query("SELECT id, name, description, price, week, time, timeStart, timeEnd FROM subscription");
$rows = $data->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    if ($row['price']%100 != 00){
        $row['price'] = $row['price']/100;
    }
    echo '<div class="col-md-4">';
        echo '<div class="card shadow-sm">';
            echo '<div class="card-header">';
                echo '<h4 class="my-0 font-weight-normal">'.$row['name'].'</h4>';
            echo "</div>";
            echo '<div class="card-body">';
                echo '<h2 class="card-title pricing-card-title">'.$row['price'].'€ TTC <small class="text-muted">/ an</small></h2>';
                echo '<ul class="list-unstyled mt-3 mb-4">';
                    echo "<li class='liSubscription'>Bénéficiez d'un accès privilégié en illimité ".$row['week']."j/7, ".$row['timeStart']."h/h".$row['timeEnd'];
                    echo '<li class="liSubscription">'.$row['description'];
                    echo '<li class="liSubscription">'.$row['time'].'h de services/mois';
                echo '</ul>';
                echo '<a class="btn btn-primary" href="modificationSubscription.php?id='.$row['id'].'">Modifier</a>';
                echo '<button class="btn btn-danger" onclick="show('.$row['id'].')">Supprimer</button>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

}

                    