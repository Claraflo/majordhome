<?php
session_start();

if(!empty($_GET)){
    $id = $_GET['id'];
}else{
    $id = 0;
}

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}

$req = $bdd->prepare("SELECT name, price, description, time, days FROM subscription WHERE id = $id");
$req->execute(array());
$subscription = $req->fetch();

$count = $req->rowCount();

if ($count == 0){
    header('Location: error.php');
}

$_SESSION["id"] = $id;
if ($subscription['price']%100 == 0){
    $price[0] = $subscription['price'];
    $price[1] = 0;
}else{
    $price = explode(".", $subscription['price']/100);
}




?>

<!DOCTYPE html>
<html>
<head>
    <title>Modification d'un abonnement</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/createSubscription.css">
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


<section >
    <?php if(!empty($_SESSION["errorsFormAuth"])){
        echo "<div class='alert alert-danger'>";
        foreach ($_SESSION["errorsFormAuth"] as $error) {
            echo "<li>".$error;
        }
        echo "</div>";
        unset($_SESSION["errorsFormAuth"]);
    }


    if(!empty($_SESSION["hackFormAuth"])){
        echo "<div class='alert alert-danger'>";
        foreach ($_SESSION["hackFormAuth"] as $hack) {
            echo "<li>".$hack;
        }
        echo "</div>";
        unset($_SESSION["hackFormAuth"]);
    }
    ?>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Modification de l'abonnement</h1>
        <hr class="hr">
    </div>
    <div class="container borderSubscription">
        <form method="POST" action="updateSubscription.php">

            <label for="title" class="lab">Titre *</label>
            <input id="title" type="text" class="form-control" required="required" name="title" placeholder="Titre" value="<?php echo isset($_SESSION["dataFormAuth"]["title"])?$_SESSION["dataFormAuth"]["title"]:$subscription['name'] ?>">


            <div class="row pt-4">
                <div class="col-md-6">
                    <label for="priceEur">Euros *</label>
                    <input name="priceEur" type="number" id="priceEur" class="form-control inputRegister" placeholder="20" required="" autocomplete="off" value="<?php echo isset($_SESSION["dataFormAuth"]["priceEur"])?$_SESSION["dataFormAuth"]["priceEur"]:$price[0] ?>">
                </div>

                <div class=" col-md-6">
                    <label for="priceCent">Centimes *</label>
                    <input name="priceCent" type="number" id="priceCent" class="form-control inputRegister" placeholder="99" required="" autocomplete="off" value="<?php echo isset($_SESSION["dataFormAuth"]["priceCent"])?$_SESSION["dataFormAuth"]["priceCent"]:$price[1] ?>">
                </div>

            </div>

            <div class="row pt-4">

                <div class="col-md-6">
                    <label for="week">Nombre de jours par semaine *</label>
                    <select name="week" id="week" class="custom-select d-block w-100">
                        <?php
                        for ($i = 1; $i < 8; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="time">Nombre d'heures autorisées par mois *</label>
                    <input id="time" type="number" class="form-control" required="required" name="time" placeholder="5" value="<?php echo isset($_SESSION["dataFormAuth"]["time"])?$_SESSION["dataFormAuth"]["time"]:$subscription['time'] ?>">
                </div>

            </div>

            <div class="row pt-4">

                <div class="col-md-6">
                    <label for="timeStart">Heure de début *</label>
                    <select name="timeStart" id="timeStart" class="custom-select d-block w-100">
                        <?php
                        for ($i = 1; $i < 25; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="timeEnd">Heure de fin *</label>
                    <select name="timeEnd" id="timeEnd" class="custom-select d-block w-100">
                        <?php
                        for ($i = 1; $i < 25; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="row pt-4">

                <div class="col-md-4">
                    <label for="years">Nombre d'années *</label>
                    <select name="years" id="years" class="custom-select d-block w-100">
                        <?php
                        for ($i = 0; $i < 11; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="months">Nombre de mois *</label>
                    <select name="months" id="months" class="custom-select d-block w-100">
                        <?php
                        for ($i = 0; $i < 12; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="days">Nombre de jours *</label>
                    <input name="days" type="number" id="days" class="form-control inputRegister" placeholder="5" required="" autocomplete="off" value="<?php echo isset($_SESSION["dataFormAuth"]["days"])?$_SESSION["dataFormAuth"]["days"]:$subscription['days'] ?>">
                </div>



            </div>


            <label for="description" class="lab area">Description *</label>
            <textarea id="description" class="form-control area" name="description" required="required" rows="3"><?php echo isset($_SESSION["dataFormAuth"]["description"])?$_SESSION["dataFormAuth"]["description"]:$subscription['description'] ?></textarea>


            <input type="submit" class="btn btn-success area" value="Modifier l'abonnement">

        </form>
    </div>
</section>

<?php unset($_SESSION["dataFormAuth"]);?>

<footer>

    <p class="text-center pt-4">Copyright © Majord'home 2020</p>

</footer>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
