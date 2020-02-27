<?php
session_start ();

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}

$data = $bdd->query("SELECT id, prenom, nom, mail, dateNaissance, adresse, ville, codePostal, telephone FROM customer WHERE status = 0");
$rows = $data->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="container">';

foreach ($rows as $row) {

    echo '<tr>';
        echo'<td>'.$row["prenom"].'</td>';
        echo '<td>'.$row["nom"].'</td>';
        echo '<td>'.$row["mail"].'</td>';
        echo '<td>'.$row["dateNaissance"].'</td>';
        echo '<td>'.$row["adresse"].'</td>';
        echo '<td>'.$row["ville"].'</td>';
        echo '<td>'.$row["codePostal"].'</td>';
        echo '<td>'.$row["telephone"].'</td>';
        echo '<td><a class="btn btn-primary" href="modificationSubscription.php?id='.$row['id'].'">Modifier</a></td>';
        echo '<td><button class="btn btn-danger" onclick="show('.$row['id'].')">Supprimer</button></td>';
    echo '</tr>';
}

echo '<div>';