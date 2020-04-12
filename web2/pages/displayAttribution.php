<?php

require('functions.php');
$connect = connectDb();

$date = $_POST['date'];

$dateExplode = explode('-', $date);
$dateCustomer = date($dateExplode[0].$dateExplode[1].$dateExplode[2]);

$data = $connect->query("SELECT personne.nom, personne.prenom, dateReservation FROM souscription_service, personne WHERE personne.idPersonne = souscription_service.FK_idPersonne AND souscription_service.statutReservation = 0 AND souscription_service.dateIntervention =".$dateCustomer);

$rows = $data->fetchAll(PDO::FETCH_ASSOC);

$req = $connect->query("SELECT idPersonne, nom, prenom FROM  personne WHERE statut = 1");

$rowsReq = $req->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {

    echo '<tr>';
        echo '<td>'.$row["prenom"].' '.$row['nom'].'</td>';
        echo '<td>'.$row['dateReservation'].'</td>';
        echo '<td>';
            echo '<select name="week" id="week" class="custom-select d-block w-100">';
                foreach ($rowsReq as $rowReq){
                    echo '<option value="'.$rowReq['idPersonne'].'">'.$rowReq['prenom'].' '.$rowReq['nom'].'</option>';
                }
            echo '</select>';
        echo '</td>';
    echo '</tr>';
}
?>
