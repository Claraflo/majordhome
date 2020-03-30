<?php
session_start ();

if (!isset($_SESSION['user']) || ($_SESSION['user']['statut'] != 2 && $_SESSION['user']['statut'] != 3)) {
    header('../Location: login.php');
}

require("../functions.php");
$connect = connectDb();


$data = $connect->query("SELECT idSouscriptionService, dateReservation, dateIntervention, duree, statutReservation, nom, idFacture FROM souscription_service, service, facture WHERE service.idService = souscription_service.FK_idService AND facture.FK_idSouscriptionService = souscription_service.idSouscriptionService AND souscription_service.FK_idPersonne =".$_SESSION['idCustomer']);

$rows = $data->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="container">';

foreach ($rows as $row) {
    echo '<tr>';
    echo'<td>'.$row["nom"].'</td>';
    echo '<td>'.$row["dateReservation"].'</td>';
    echo '<td>'.$row["dateIntervention"].'</td>';
    echo '<td>'.$row["duree"].'</td>';
    if ($row['statutReservation'] == 0){
        echo '<td id="green"><b>En cours</b></td>';
    }else if($row['statutReservation'] == -1){
        echo '<td id="red"><b>Supprimer</b></td>';
    }
    echo '<td>';
    if($row['statutReservation'] == 0) {
        echo '<a class="btn btn-primary my-primary" href="modificationReservationBack.php?id=' . $row['idSouscriptionService'] . '">Modifier</a>';
        echo '<button class="btn btn-danger my-danger" onclick="show(\'' . $row["idSouscriptionService"] . '\',' . $row['idFacture'] . ')">Supprimer</button>';
    }
    echo '</td>';
    echo '</tr>';
}

echo '<div>';