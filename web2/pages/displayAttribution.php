<?php

require('functions.php');
$connect = connectDb();

$date = $_POST['date'];

$dateExplode = explode('-', $date);
$dateCustomer = date($dateExplode[0].$dateExplode[1].$dateExplode[2]);

$data = $connect->query("SELECT personne.idPersonne, personne.nom, personne.prenom, souscription_service.dateReservation, souscription_service.idSouscriptionService, souscription_service.FK_idPrestataire, souscription_service.dateIntervention, souscription_service.duree FROM souscription_service, personne WHERE personne.idPersonne = souscription_service.FK_idPersonne AND souscription_service.statutReservation = 0 AND souscription_service.dateIntervention =".$dateCustomer);

$rows = $data->fetchAll(PDO::FETCH_ASSOC);

$req = $connect->query("SELECT idPersonne, nom, prenom FROM  personne WHERE statut = 1");

$rowsReq = $req->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {

    echo '<tr>';
        echo '<td>'.$row["prenom"].' '.$row['nom'].'</td>';
        echo '<td>'.$row['dateReservation'].'</td>';
        echo '<td>'.$row['dateIntervention'].'</td>';
        echo '<td>'.$row['duree'].'</td>';
        echo '<td>';
        if (empty($row['FK_idPrestataire'])) {
                echo '<select id="'.$row["idPersonne"].'" class="custom-select d-block w-100">';
                    foreach ($rowsReq as $rowReq){
                        echo '<option value="'.$rowReq['idPersonne'].'">'.$rowReq['prenom'].' '.$rowReq['nom'].'</option>';
                    }
                echo '</select>';
                echo '<button class="btn btn-success" onclick="attribution(' . $row["idPersonne"] . ',\'' . $row["idSouscriptionService"] . '\')">Attribuer</button>';
            }else{
                echo '<button class="btn btn-danger" onclick="deleteAttribution(' . $row["idPersonne"] . ',\'' . $row["idSouscriptionService"] . '\')">X</button>';
            }
        echo '</td>';
    echo '</tr>';
}
?>
