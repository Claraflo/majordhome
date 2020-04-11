<?php 

$month = $_GET['month'];
$year = $_GET['year'];

include 'functionsCalendar.php';

?>

<h1 id="titleCalendar"><?php echo month($month)." ".$year; ?></h1>

<div>
	<?php calendar($month, $year); ?>
</div>