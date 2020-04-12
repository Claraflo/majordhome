<?php
require("header.php");

if (!isset($_GET['date'])){
    header('Location: dashboard.php');
}

$date = $_GET['date'];

$date = explode('-', $date);

?>
<h1 id="titleAttribution"><?php echo $date[2]."-".$date[1]."-".$date[0] ?></h1>

<table class="table table-striped" id="tabAttribution">
    <thead>
    <tr>
        <th scope="col">Prestataires</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
    </tr>
    <tr>
        <th scope="row">2</th>
    </tr>
    <tr>
        <th scope="row">3</th>
    </tr>
    </tbody>
</table>
