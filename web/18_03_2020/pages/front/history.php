<?php
require "header.php";
?>

<section class="pt-5 servicesSection" id="HistorySection">

        <div class="row" id="tabSection">

            <nav id="navHistory" class="col-2" >

                <ul class="">
                    <li class="">
                        <a  class="nav-link colorLink" onclick="displayHisSubscription()">Historique Abonnements</a>
                    </li>
                    <li class="">
                        <a class="nav-link colorLink" onclick="displayHisService()">Historique Service</a>
                    </li>
                    <li class="">
                        <a class="nav-link colorLink" onclick="displayHisBill()">Historique paiements</a>
                    </li>
                </ul>

            </nav>

            <div class="col">
                <div id="tableHistory">

                    <div id="tableHisSubscription">
                        <?php

                        $connect=  connectDb();

                        $query = $connect->query('SELECT abonnement.nom,DATE_FORMAT(dateAchat,"%d/%m/%Y") as dateAchat,DATE_FORMAT(dateFin,"%d/%m/%Y") as dateFin, souscription_abonnement.statut FROM souscription_abonnement,abonnement  WHERE abonnement.idAbonnement = souscription_abonnement.FK_idAbonnement  AND FK_idPersonne ='.$_SESSION['user']['idPersonne']);
                        $query->execute();

                        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

                        echo '<table class="table" >';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th id = "titleTable" >Abonnements en cours</th>';
                        echo '<th>';
                        echo '<th>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th class="SubtitleTable">Abonnements</th>';
                        echo '<th class="SubtitleTable">Date début</th>';
                        echo '<th class="SubtitleTable">Date Fin</th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                            foreach ($rows as $row) {

                                if($row["statut"] ==0) {
                                    echo '<tr>';
                                    echo '<td>' . $row["nom"] . '</td>';
                                    echo '<td>' . $row["dateAchat"] . '</td>';
                                    echo '<td>' . $row["dateFin"] . '</td>';
                                    echo '</tr>';
                                }
                            }
                        echo '</tbody>';
                            echo '</table>';

                        echo '<br>';

                        echo '<table class="table" >';
                            echo '<thead>';
                            echo '<tr>';
                                echo '<th id = "titleTable" >Abonnements terminés</th>';
                                echo '<th>';
                                    echo '<th>';
                                    echo '</tr>';
                            echo '<tr>';
                                echo '<th class="SubtitleTable">Abonnements</th>';
                                echo '<th class="SubtitleTable">Date début</th>';
                                echo '<th class="SubtitleTable">Date Fin</th>';
                                echo '</tr>';
                            echo '</thead>';

                            echo '<tbody>';

                            foreach ($rows as $row) {

                                if ($row["statut"] == -1) {
                                    echo '<tr>';
                                    echo '<td>' . $row["nom"] . '</td>';
                                    echo '<td>' . $row["dateAchat"] . '</td>';
                                    echo '<td>' . $row["dateFin"] . '</td>';
                                    echo '</tr>';
                                }
                            }
                            echo '</tbody>';
                            echo '</table>';
                        ?>

                    </div>

                    <div id="tableHisServices">

                        <?php
                        $connect=  connectDb();

                        $query = $connect->query('SELECT service.nom,DATE_FORMAT(dateReservation,"%d/%m/%Y") as dateAchat,DATE_FORMAT(dateIntervention,"%d/%m/%Y") as dateFin, souscription_service.statutReservation as statut FROM souscription_service,service  WHERE service.idService = souscription_service.FK_idService  AND souscription_service.FK_idPersonne ='.$_SESSION['user']['idPersonne']);
                        $query->execute();

                        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

                        echo '<table class="table" >';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th id = "titleTable" >Services en cours ou à venir </th>';
                        echo '<th>';
                        echo '<th>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th class="SubtitleTable">Services</th>';
                        echo '<th class="SubtitleTable">Date début</th>';
                        echo '<th class="SubtitleTable">Date Fin</th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                        foreach ($rows as $row) {

                            if($row["statut"] ==0) {
                                echo '<tr>';
                                echo '<td>' . $row["nom"] . '</td>';
                                echo '<td>' . $row["dateAchat"] . '</td>';
                                echo '<td>' . $row["dateFin"] . '</td>';
                                echo '</tr>';
                            }
                        }
                        echo '</tbody>';
                        echo '</table>';

                        echo '<br>';

                        echo '<table class="table" >';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th id = "titleTable" >Services terminés</th>';
                        echo '<th>';
                        echo '<th>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th class="SubtitleTable">Services</th>';
                        echo '<th class="SubtitleTable">Date début</th>';
                        echo '<th class="SubtitleTable">Date Fin</th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                        foreach ($rows as $row) {

                            if ($row["statut"] == 1) {
                                echo '<tr>';
                                echo '<td>' . $row["nom"] . '</td>';
                                echo '<td>' . $row["dateAchat"] . '</td>';
                                echo '<td>' . $row["dateFin"] . '</td>';
                                echo '</tr>';
                            }
                        }
                        echo '</tbody>';
                        echo '</table>';
                        ?>

                    </div>

                    <div id="tableHisBill">

                        <?php
                        $connect=  connectDb();

                        $query = $connect->query('SELECT facture.idFacture,service.nom,DATE_FORMAT(facture.dateEmission,"%d/%m/%Y") as dateEmission,facture.prixTotal,facture.sommeRestante FROM service, facture, souscription_service WHERE facture.FK_idSouscriptionService = souscription_service.idSouscriptionService AND souscription_service.FK_idService = service.idService AND facture.FK_idPersonne ='.$_SESSION['user']['idPersonne']);
                        $query->execute();

                        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

                        echo '<table class="table" >';

                        echo '<thead>';
                        echo '<tr>';
                        echo '<th></th>';
                        echo '<th></th>';
                        echo '<th>Factures à regler</th>';
                        echo '<th></th>';
                        echo '<th></th>';
                        echo '<th></th>';
                        echo '<th></th>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th class="SubtitleTable">Numéro Facture</th>';
                        echo '<th class="SubtitleTable">Nom Service</th>';
                        echo '<th class="SubtitleTable">Date Emission</th>';
                        echo '<th class="SubtitleTable">Prix total</th>';
                        echo '<th class="SubtitleTable">Somme Restante</th>';
                        echo '<th class="SubtitleTable">PDF</th>';
                        echo '<th class="SubtitleTable">Regler</th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                        foreach ($rows as $row) {

                            if($row["sommeRestante"] !=0) {

                                echo '<tr>';
                                echo '<td>' . $row["idFacture"] . '</td>';
                                echo '<td>' . $row["nom"] . '</td>';
                                echo '<td>' . $row["dateEmission"] . '</td>';
                                echo '<td>' . $row["prixTotal"]/100 . '€</td>';
                                echo '<td>' . $row["sommeRestante"]/100 . '€</td>';
                                echo '<td><button type="button" class="btn btn-dark">PDF</button></td>';
                                echo '<td><button type="button" class="btn btn-warning">Regler</button></td>';
                                echo '</tr>';
                            }
                        }
                        echo '</tbody>';
                        echo '</table>';

                        echo '<br>';

                        echo '<table class="table" >';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th id = "titleTable" >Factures réglées</th>';
                        echo '<th></th>';
                        echo '<th></th>';
                        echo '<th></th>';
                        echo '<th></th>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th class="SubtitleTable">Numéro Facture</th>';
                        echo '<th class="SubtitleTable">Nom Service</th>';
                        echo '<th class="SubtitleTable">Date Emission</th>';
                        echo '<th class="SubtitleTable">Prix total</th>';
                        echo '<th class="SubtitleTable">PDF</th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                        foreach ($rows as $row) {

                            if ($row["sommeRestante"] == 0) {
                                echo '<tr>';
                                echo '<td>' . $row["idFacture"] . '</td>';
                                echo '<td>' . $row["nom"] . '</td>';
                                echo '<td>' . $row["dateEmission"] . '</td>';
                                echo '<td>' . $row["prixTotal"]/100 . '€</td>';
                                echo '<td><button type="button" class="btn btn-dark" onclick="">PDF</button></td>';
                                echo '</tr>';
                            }
                        }
                        echo '</tbody>';
                        echo '</table>';
                        echo '<br>';

                        ?>

                    </div>

            </div>
        </div>

</section>

    <script src="../../js/history.js"></script>

<?php
require "../footer.php";
?>