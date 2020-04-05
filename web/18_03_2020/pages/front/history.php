<?php
require "header.php";
?>

<section class="pt-5 servicesSection" id="HistorySection">

        <div class="row" id="tabSection">

            <nav id="navHistory" class="col-2" >

                <ul class="">
                    <li class="">
                        <a  class="nav-link colorLink">Historique Abonnements</a>
                    </li>
                    <li class="">
                        <a class="nav-link colorLink" href="#">Historique Service</a>
                    </li>
                    <li class="">
                        <a class="nav-link colorLink" href="#">Historique paiements</a>
                    </li>
                </ul>

            </nav>

            <div class="col">
                <div id="tableHistory">

                        <?php

                        $connect=  connectDb();
                        $query = $connect->query('SELECT nom FROM type');
                        $query->execute();

                        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

                        echo '<table class="table" >';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<td> NOM</td>';
                        echo '</tr>';
                        echo '<tbody>';

                            foreach ($rows as $row) {

                                echo '<table class="table">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<td>'.$row["nom"].'</td>';
                                echo '</tr>';

                            }
                        echo '</tbody>';
                            echo '</table>';
                        ?>

                </div>
            </div>
        </div>

</section>



<?php
require "../footer.php";
?>