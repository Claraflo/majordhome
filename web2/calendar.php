<?php

session_start();







// Les mois
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // Le mois en ce moment
    $ym = date('Y-m');
}

// Check le format
$timestamp = strtotime($ym . '-01');  // Premier jour du mois
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
// Aujourd'hui
$today = date('Y-m-j');
// Titre
$title = date('F, Y', $timestamp);
// Boutton selection du mois
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));
// Nombre de jour du mois
$day_count = date('t', $timestamp);
// Jour de la semaine
$str = date('N', $timestamp);
// Tableau de la semaine
$weeks = [];
$week = '';
// Ajout de cellule vide
$week .= str_repeat('<td></td>', $str - 1);
for ($day = 1; $day <= $day_count; $day++, $str++) {
    $date = $ym . '-' . $day;


    // ------------Affichage cercle --------------






    if ($today == $date) {

        $circle = 0;



        if ($circle == 0) {
            $week .= '<td class="today"><a class="linkAgenda" href="calendarClientForm.php?agendaDay=' . $today . '" >';
        }

    } else {
        $circle = 0;


        if ($circle == 0) {
            $week .= '<td><a class="linkAgenda" href="calendarClientForm.php?agendaDay=' . $day . '-' . $title . '">';
        }

    }

    $week .= $day . '</a></td>';
    // Dernier jour de la semaine
    if ($str % 7 == 0 || $day == $day_count) {
        // Dernier jour du mois
        if ($day == $day_count && $str % 7 != 0) {
            // Ajout cellule vide
            $week .= str_repeat('<td></td>', 7 - $str % 7);
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        $week = '';
    }
}


?>
<html>
<link rel="stylesheet" type="text/css" href="agenda.css"/>
<body>


<!-- MAIN CONTENT-->
<div class="container">
    <ul class="list-inline">
        <li class="list-inline-item"><a href="?ym=<?= $prev; ?>" class="btn btn-link">&lt; prev</a>
        <li class="list-inline-item"><span class="title"><?= $title; ?></span>
        <li class="list-inline-item"><a href="?ym=<?= $next; ?>" class="btn btn-link">next &gt;</a>
    </ul>

    <p class="text-right"><a href="calendarClient.php">Today</a></p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
            <th>Sunday</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($weeks as $week) {
            echo $week;
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>