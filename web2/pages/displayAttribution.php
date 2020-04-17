<?php

require('functions.php');
$connect = connectDb();

$date = $_POST['date'];


$data = $connect->query("SELECT personne.idPersonne, personne.nom, personne.prenom, souscription_service.dateReservation, souscription_service.idSouscriptionService, souscription_service.FK_idPrestataire, souscription_service.dateIntervention, souscription_service.duree FROM souscription_service, personne WHERE personne.idPersonne = souscription_service.FK_idPersonne AND souscription_service.statutReservation = 0 ORDER BY souscription_service.dateIntervention");

$rows = $data->fetchAll(PDO::FETCH_ASSOC);

$req = $connect->query("SELECT idPersonne, nom, prenom FROM  personne WHERE statut = 1");

$rowsReq = $req->fetchAll(PDO::FETCH_ASSOC);


foreach ($rows as $row) {
    $dateExplode = explode(' ',$row['dateIntervention']);
    if ($date == $dateExplode[0]){  //On vérifie que la date correspond à la page
        echo '<tr>';
        echo '<td>' . $row["prenom"] . ' ' . $row['nom'] . '</td>';
        echo '<td>' . $row['dateReservation'] . '</td>';
        echo '<td>' . $row['dateIntervention'] . '</td>';
        echo '<td>' . $row['duree'] . '</td>';
        $timeService = explode(' ', $row['dateIntervention']);

        echo '<td>';
        if (empty($row['FK_idPrestataire'])) { //Si il n'y a pas de presta
            echo '<select id="' . $row["idPersonne"] . '" class="custom-select d-block w-100">';

            foreach ($rowsReq as $rowReq) {
                $result = $connect->query("SELECT dateIntervention FROM  souscription_service WHERE statutReservation = 0 AND FK_idPrestataire =".$rowReq['idPersonne']); //Vérification de l'horaire
                $resultData = $result->fetchAll(PDO::FETCH_ASSOC);

                $tabTime = [];

                foreach ($resultData as $resData) {
                    $time = explode(' ', $resData['dateIntervention']); //Récup heures
                    if ($time[0] == $date){
                        $tabTime[] = $time[1];
                    }
                }
                $countSoustraction = 0;

                if (!empty($tabTime)){
                    for ($i = 0; $i < count($tabTime); $i++){

                        $resultSoustraction = date('H:i:s', strtotime($timeService[1]) - strtotime($tabTime[$i]));//Soustraction

                        if ((strtotime($resultSoustraction) <= strtotime('1:00:00') && strtotime($resultSoustraction) >= strtotime('00:00:01')) || (strtotime($resultSoustraction) >= strtotime('23:00:00') && strtotime($resultSoustraction) <= strtotime('23:59:59')) || (strtotime($resultSoustraction) == strtotime('00:0:00'))){
                            $countSoustraction = 1;
                        }
                    }
                }
                if ($countSoustraction != 1){
                    echo '<option value="' . $rowReq['idPersonne'] . '">' . $rowReq['prenom'] . ' ' . $rowReq['nom'] . '</option>';
                }
                unset($tabTime);

            }
            echo '</select>';
            echo '<button class="btn btn-success" onclick="attribution(' . $row["idPersonne"] . ',\'' . $row["idSouscriptionService"] . '\')">Attribuer</button>';
        } else {
            echo '<button class="btn btn-danger" onclick="deleteAttribution(' . $row["idPersonne"] . ',\'' . $row["idSouscriptionService"] . '\')">X</button>';
        }
        echo '</td>';
        echo '</tr>';
    }
}
?>