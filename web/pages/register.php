<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/register.css">
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


<section class="text-center">
    <form class="form-signin">
        <img class="mb-4" src="../img/icon.png" alt="" width="72" height="72">

        <div class="mb-3">
            <label for="firstName">Prénom</label>
            <input type="text" id="firstName" class="form-control inputRegister" placeholder="Jean" required="" autocomplete="off" autofocus="">
        </div>

        <div class="mb-3">
            <label for="lastName">Nom</label>
            <input type="text" id="lastName" class="form-control inputRegister" placeholder="Dufour" required="" autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="inputEmail">Email</label>
            <input type="email" id="inputEmail" class="form-control inputRegister" placeholder="jeandufour@gmail.com" required="" autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="date">Date de naissance</label>
            <input type="date" id="date" class="form-control inputRegister" required="" autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="phone">Téléphone</label>
            <input type="tel" id="phone" class="form-control inputRegister" placeholder="0606060606" required="" autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="address">Adresse</label>
            <input type="text" id="address" class="form-control inputRegister" placeholder="Adresse" required="" autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="code">Code postal</label>
            <input type="text" id="code" class="form-control inputRegister" placeholder="75000" required="" autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="inputPassword">Mot de passe</label>
            <input type="password" id="inputPassword" class="form-control inputRegister" required="" autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="inputConfirm">Confirmation du mot de passe</label>
            <input type="password" id="inputConfirm" class="form-control inputRegister" required="" autocomplete="off">
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Inscription</button>
    </form>
</section>


<footer>

    <p class="text-center pt-4">Copyright © Majord'home 2020</p>

</footer>

















<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>