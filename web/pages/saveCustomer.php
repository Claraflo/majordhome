<?php

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}


session_start();

if(count($_POST) == 10
    && !empty($_POST['firstName'])
    && !empty($_POST['lastName'])
    && !empty($_POST['email'])
    && !empty($_POST['date'])
    && !empty($_POST['phone'])
    && !empty($_POST['address'])
    && !empty($_POST['city'])
    && !empty($_POST['code'])
    && !empty($_POST['pwd'])
    && !empty($_POST['pwdConfirm'])
){


    $email = trim($_POST['email']);
    $pwd = $_POST['pwd'];
    $pwdConfirm = $_POST['pwdConfirm'];
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $phone = trim($_POST['phone']);
    $code = trim($_POST['code']);
    $birthday = trim($_POST['date']);

    $address = $_POST['address'];
    $city = $_POST['city'];

    $errors = [];




    if(!preg_match('/^[a-zA-Z0-9_éçèàôùîï]+$/', $lastName)) {
        $errors['lastName'] = "Le nom que vous avez indiqué n'est pas valide.";
    }

    if(!preg_match('/^[a-zA-Z0-9_éçèàôùîï]+$/', $firstName)) {
        $errors['firstName'] = "Le prénom que vous avez indiqué n'est pas valide.";
    }

    if( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email que vous avez indiqué n'est pas valide.";
    } else {


        $req = $bdd->prepare("SELECT id FROM customer WHERE mail = :mail");
        $req->execute([":mail" => $email]);

        if (!empty($req->fetchAll())) {

            $errors['email']= "Email déjà existant";
        }
    }

    if( $pwd == $lastName
        || $pwd == $firstName
        || strlen($pwd)<8
        || strlen($pwd)>64
        || !preg_match("#[a-z]#", $pwd)
        || !preg_match("#[A-Z]#", $pwd)
        || !preg_match("#[0-9]#", $pwd)) {
        $errors['pwd'] = "Le mot de passe que vous avez indiqué n'est pas valide, il doit faire entre 8 et 64 caractères avec des minuscules, majuscules et chiffres.";
    }



    if($pwd != $pwdConfirm){

        $errors['pwdConfirm']= "La confirmation de votre mot de passe ne correspond pas à votre mot de passe";
    }

    if(strlen($phone) != 10
        || !preg_match('/^[0-9_]+$/', $phone)) {
        $errors['phone'] = "Le numéro de téléphone que vous avez indiqué n'est pas valide.";
    } else {

        $req = $bdd->prepare('SELECT id FROM customer WHERE telephone = :tel');
        $req->execute([ ":tel " => $phone]);

        if (!empty($req->fetchAll())) {

            $errors['phone'] = "Ce numéro de téléphone est déjà utilisé.";
        }
    }


    if(strlen($code) != 5 || !preg_match('/^[0-9_]+$/', $code)) {
        $errors['code'] = "Le code postal que vous avez indiqué n'est pas valide.";
    }

    //Date de naissance entre 18ans et 120ans
    if (!preg_match("#\d{4}-\d{2}-\d{2}#", $birthday)){
        $errors[] = " Votre date de naissance doit être au format YYYY-MM-DD";
    }else{

        //Je dois mettre dans des variables le mois le jour et l'année
        $birthdayExploded = explode("-", $birthday);

        //Time correspond au nombre de secondes depuis 1 Jan 1970
        //
        //
        $secondeLife = time() - strtotime($birthday);
        $yearLife = $secondeLife/3600/24/365.242;

        if( !checkdate($birthdayExploded[1], $birthdayExploded[2], $birthdayExploded[0])  ){
            $errors[] = "Votre date de naissance n'existe pas";
        }else if ($yearLife<18 || $yearLife>120) {
            $errors[] = " Vous être trop jeunes ou trop vieux";
        }
    }


    if(empty($errors)) {
        $confirm[] = "Merci pour votre inscription";
        $_SESSION["confirmFormAuth"] = $confirm;


        $queryPrepared = $bdd->prepare("INSERT INTO customer(mail,pwd,nom,prenom,dateNaissance,telephone,adresse,ville,codePostal,status) VALUES (:mail,:pwd,:nom,:prenom,:dateNaissance,:tel,:adresse,:ville,:codePostal,1)");

        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

        $queryPrepared->execute([

            ":mail"=>$email,
            ":pwd"=>$pwd,
            ":nom"=>$lastName,
            ":prenom"=>$firstName,
            ":dateNaissance"=>$birthday,
            ":tel"=>$phone,
            ":adresse"=>$address,
            ":ville"=>$city,
            ":codePostal"=>$code


        ]);



        header("Location: createCustomer.php");
    }

    if (!empty($errors)){
        $_SESSION["errorsFormAuth"] = $errors;
        unset($_POST["pwd"]);
        unset($_POST["pwdConfirm"]);
        $_SESSION["dataFormAuth"] = $_POST;
        header("Location: createCustomer.php");
    }
}else{
    $Hack[] = "Tentative de hack detectée";
    $_SESSION["hackFormAuth"] = $Hack;
    header("Location: createCustomer.php");
}