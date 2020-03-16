<?php
session_start ();

if (!isset($_SESSION['user']) || ($_SESSION['user']['statut'] != 2 && $_SESSION['user']['statut'] != 3)) {
    header('../Location: login.php');
}

require("../functions.php");
$connect = connectDb();


$data = $connect->query("SELECT id, nom, dateReservation, dateIntervention FROM reservation");

$rows = $data->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="container">';

foreach ($rows as $row) {

    echo '<tr>';
    echo'<td>'.$row["nom"].'</td>';
    echo '<td>'.$row["dateReservation"].'</td>';
    echo '<td>'.$row["dateIntervention"].'</td>';
    echo '<td>';
    echo '<a class="btn btn-primary" href="modificationCustomer.php?id='.$row['id'].'">Modifier</a>';
    echo '<button class="btn btn-danger" onclick="show('.$row['id'].')">Supprimer</button>';
    echo '</td>';
    echo '</tr>';
}

echo '<div>';