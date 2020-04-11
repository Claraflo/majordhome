<?php 

$mois = $_GET['mois'];
$annee = $_GET['annee'];

include 'functionsCalendar.php';

?>

<h1 id="titleCalendar"><?php echo mois($mois)." ".$annee; ?></h1>

<div>
	<?php calendrier($mois, $annee); ?>
</div>