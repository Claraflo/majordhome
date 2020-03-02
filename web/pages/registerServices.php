<?php
require('functions.php');
session_start();

if(!empty($_GET)){
    $id = $_GET['id'];
}else{
    $id = 0;
}

$connect = connectDb();


$req = $connect->prepare("SELECT nom, type FROM caracteristique WHERE idService = $id");
$req->execute(array());

$count = $req->rowCount();

if ($count == 0){
    header('Location: error.php');
}
$_SESSION["id"] = $id;

$data= $connect->query("SELECT nom, prix FROM service WHERE idService = $id");



?>
<!DOCTYPE html>
<html>
<head>
    <title>Réservation</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/registerServices.css">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Lien police d'écriture -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <!-- Lien Icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark" id="nav">
        <div class="container">
            <a class="navbar-brand active" href="index.php" title="">
                <img class="logo" src="../img/majordhome.png" title="logo" alt="Logo Majord'home">
            </a>
        </div>
    </nav>
</header>

<?php if (!empty($_SESSION['success'])){
    echo $_SESSION["success"];
}
?>

<section >
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <?php
            foreach ($data->fetchAll() as $service){
                echo '<h1 class="display-4">'.$service["nom"].'</h1>';
                echo '<h5>'.$service["prix"].' €</h5>';
            }
        ?>
        <hr class="hr">
    </div>
    <form method="post" action="payment.php">
        <div class="container borderSubscription">

            <?php
                foreach ($req->fetchAll() as $caracteristique) {

                    echo '<label for="'.$caracteristique["nom"].'" class="lab area">'.$caracteristique["nom"].'</label>';
                    echo '<input name="'.$caracteristique["nom"].'" type="'.$caracteristique["type"].'" id="'.$caracteristique["nom"].'" class="form-control inputRegister" required="">';
                }
            ?>

            <input type="submit" class="btn btn-success area" value="Payer">

        </div>
    </form>
</section>


<footer class="container-fluid footer">
    <div class="container">
        <p class="text-center pt-4">Copyright © Majord'home 2020</p>
    </div>
</footer>


<script src="../js/payment.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>