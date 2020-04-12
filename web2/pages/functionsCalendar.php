<?php


function calendar($month, $year)
{

    require('functions.php');

    if ($month < 10){
        $month = '0'.$month;
    }

    $obj = json('souscription_service.json');
    for ($i = 0; $i < count($obj); $i++){
        $explode = explode(' ', $obj[$i]-> dateIntervention);
        $dateService[$i] = $explode[0];
    }

    $dayToday = date('d');
    $monthToday = date('m');
    $yearToday = date('Y');

	$nombre_de_jour = cal_days_in_month(CAL_GREGORIAN, $month, $year);

	echo "<table>";

	echo "<tr><th>Lundi</th><th>Mardi</th><th>Mercredi</th><th>Jeudi</th><th>Vendredi</th><th>Samedi</th><th>Dimanche</th></tr>";

	for ($i=1; $i <= $nombre_de_jour ; $i++)
	{ 
	    $date = ($year.'-'.$month.'-'.$i);


		$jour = cal_to_jd(CAL_GREGORIAN, $month, $i, $year);
		$jour_semaine = JDDayOfWeek($jour);

		if ($i == $nombre_de_jour)
		{
		
			if ($jour_semaine == 1)
			{
				echo "<tr>";
			}

            $count = 0;

            for ($j = 0; $j < count($dateService); $j++){
                if($date == $dateService[$j]){
                    $count++;
                }
            }

			if ($i == $dayToday && $month == $monthToday && $year == $yearToday){
                echo "<td class='case' id='today' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><p class='numberCalendar'>" . $i . "</p></td></tr>";
            }else if ($count != 0){
                echo "<td class='case' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><span class='badge badge-primary'>".$count."</span><p class='numberCalendar'>".$i."</p></td></tr>";
            }else{
                echo "<td class='case' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><p class='numberCalendar'>" . $i . "</p></td></tr>";
            }

		}elseif ($i == 1)
		{
		
			echo "<tr>";

			if ($jour_semaine == 0) 
			{
				$jour_semaine = 7;
			}

			for ($k=1; $k != $jour_semaine ; $k++)
			{ 
				echo "<td></td>";
			}

            $count = 0;

            for ($j = 0; $j < count($dateService); $j++){
                if($date == $dateService[$j]){
                    $count++;
                }
            }

            if ($i == $dayToday && $month == $monthToday && $year == $yearToday){
                echo "<td class='case' id='today' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><p class='numberCalendar'>" . $i . "</p></td>";
            }else if ($count != 0){
                echo "<td class='case' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><span class='badge badge-primary'>".$count."</span><p class='numberCalendar'>".$i."</p></td>";
            }else{
                echo "<td class='case' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><p class='numberCalendar'>" . $i . "</p></td>";
            }


			if ($jour_semaine == 7)
			{
				echo "</tr>";
			}

		}else
		{

			if ($jour_semaine == 1)
			{
				echo "<tr>";
			}

            $count = 0;

            for ($j = 0; $j < count($dateService); $j++){
                if($date == $dateService[$j]){
                    $count++;
                }
            }

            if ($i == $dayToday && $month == $monthToday && $year == $yearToday){
                echo "<td class='case' id='today' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><p class='numberCalendar'>" . $i . "</p></td>";
            }else if ($count != 0){
                echo "<td class='case' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><span class='badge badge-primary'>".$count."</span><p class='numberCalendar'>".$i."</p></td>";
            }else{
                echo "<td class='case' onclick=\"location.href='attribution.php?date=".$year."-".$month."-".$i."'\"><p class='numberCalendar'>" . $i . "</p></td>";
            }


			if ($jour_semaine == 0) {
				echo "</tr>";
			}

		}

	}

	echo "</table>";

}


function month($p) {

	$z = $p-1;

	$table = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

	return $table[$z];

}

?>