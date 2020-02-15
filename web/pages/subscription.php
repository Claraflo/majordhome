<?php
session_start();

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/subscription.css">
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
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Abonnements</h1>
        <hr class="hr">
    </div>
    <form method="post">
    <div class="container borderSubscription">
        <div class="row text-center">
            <?php
            $data = $bdd->query("SELECT id, name, price, duration, description FROM subscription");
            foreach ($data->fetchAll() as $key => $subscription) {
                    if ($subscription['price']%100 != 00){
                        $subscription['price'] = $subscription['price']/100;
                    }
                    echo '<div class="col-md-4">';
                        echo '<div class="card shadow-sm">';
                            echo '<div class="card-header">';
                                echo '<h4 class="my-0 font-weight-normal">'.$subscription['name'].'</h4>';
                            echo "</div>";
                            echo '<div class="card-body">';
                                echo '<h2 class="card-title pricing-card-title">'.$subscription['price'].'€ TTC <small class="text-muted">/ an</small></h2>';
                                echo '<ul class="list-unstyled mt-3 mb-4">';
                                    echo '<li class="liSubscription">'.$subscription['description'];
                                echo '</ul>';
                                echo '<a class="btnSubscription" href="payment.php?id='.$subscription['id'].'">Payer</a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
    </form>
</section>


<footer>

    <p class="text-center pt-4">Copyright © Majord'home 2020</p>

</footer>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>