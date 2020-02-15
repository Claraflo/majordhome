<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
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
    ?>

    <?php if(!empty($_SESSION["hackFormAuth"])){
        echo "<div class='alert alert-danger'>";
        foreach ($_SESSION["hackFormAuth"] as $hack) {
            echo "<li>".$hack;
        }
        echo "</div>";
        unset($_SESSION["hackFormAuth"]);
    }
    ?>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Création d'un abonnement</h1>
        <hr class="hr">
    </div>
    <div class="container borderSubscription">
        <form method="POST" action="saveSubscription.php">

            <label for="title" class="lab">Titre *</label>
            <input id="title" type="text" class="form-control" required="required" name="title" placeholder="Titre" autofocus="" value="<?php echo isset($_SESSION["dataFormAuth"]["title"])?$_SESSION["dataFormAuth"]["title"]:"" ?>">


            <div class="row pt-4">
                <div class="col-md-6">
                    <label for="priceEur">Euros *</label>
                    <input name="priceEur" type="text" id="priceEur" class="form-control inputRegister" placeholder="20" required="" autocomplete="off" value="<?php echo isset($_SESSION["dataFormAuth"]["priceEur"])?$_SESSION["dataFormAuth"]["priceEur"]:"" ?>">
                </div>

                <div class=" col-md-6">
                    <label for="priceCent">Centimes *</label>
                    <input name="priceCent" type="text" id="priceCent" class="form-control inputRegister" placeholder="99" required="" autocomplete="off" value="<?php echo isset($_SESSION["dataFormAuth"]["priceCent"])?$_SESSION["dataFormAuth"]["priceCent"]:"" ?>">
                </div>

            </div>

            <label for="description" class="lab">Description *</label>
            <textarea id="description" class="form-control" name="description" required="required" rows="3"><?php echo isset($_SESSION["dataFormAuth"]["description"])?$_SESSION["dataFormAuth"]["description"]:"" ?></textarea>


            <input type="submit" class="btn btn-success" value="Ajouter un abonnement">

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
