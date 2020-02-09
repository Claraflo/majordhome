<?php
session_start();

if(count($_POST) == 11
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
    && !empty($_POST['captcha'])
){


        $errors = [];

        $captcha = strtolower($_POST['captcha']);


        //Vérif du captcha
        if( $captcha != $_SESSION["captcha"]){
            $errors[] = "Captcha incorrect";
        }


        if(empty($_POST['lastName']) || !preg_match('/^[a-zA-Z0-9_éçèàôùîï]+$/', $_POST['lastName'])) {
            $errors['lastName'] = "Le nom que vous avez indiqué n'est pas valide.";
        }

        if(empty($_POST['firstName']) || !preg_match('/^[a-zA-Z0-9_éçèàôùîï]+$/', $_POST['firstName'])) {
            $errors['firstName'] = "Le prénom que vous avez indiqué n'est pas valide.";
        }

        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'email que vous avez indiqué n'est pas valide.";
        } //else {
//            $req = $bdd->prepare('SELECT id FROM users WHERE email = ?');
//            $req->execute([$_POST['email']]);
//            $user = $req->fetch();
//            if($user) {
//                $errors['email'] = "Cet email est déjà utilisé.";
//            }
//        }

        if(empty($_POST['pwd'])
            || $_POST['pwd'] == $_POST['lastName']
            || $_POST['pwd'] == $_POST['firstName']
            || $_POST['pwd'] != $_POST['pwdConfirm']
            || strlen($_POST['pwd'])<8
            || strlen($_POST['pwd'])>64
            || !preg_match("#[a-z]#", $_POST['pwd'])
            || !preg_match("#[A-Z]#", $_POST['pwd'])
            || !preg_match("#[0-9]#", $_POST['pwd'])) {
            $errors['pwd'] = "Le mot de passe que vous avez indiqué n'est pas valide, il doit faire entre 8 et 64 caractères avec des minuscules, majuscules et chiffres.";
        }

        if(empty($_POST['phone'])
            || strlen($_POST['code'])<5
            || strlen($_POST['code'])>5
            || !preg_match('/^[0-9_]+$/', $_POST['phone'])) {
            $errors['phone'] = "Le numéro de téléphone que vous avez indiqué n'est pas valide.";
        } //else {
    //        $req = $bdd->prepare('SELECT id FROM users WHERE phone = ?');
    //        $req->execute([$_POST['phone']]);
    //        $user = $req->fetch();
    //        if($user) {
    //            $errors['phone'] = "Ce numéro de téléphone est déjà utilisé.";
    //        }
    //    }


        if(empty($_POST['code']) || !preg_match('/^[0-9_]+$/', $_POST['code'])) {
            $errors['code'] = "Le code postal que vous avez indiqué n'est pas valide.";
        }

        //Date de naissance entre 18ans et 120ans
        if (!preg_match("#\d{4}-\d{2}-\d{2}#", $_POST['date'])){
            $errors[] = " Votre date de naissance doit être au format YYYY-MM-DD";
        }else{

            //Je dois mettre dans des variables le mois le jour et l'année
            $birthdayExploded = explode("-", $_POST['date']);

            //Time correspond au nombre de secondes depuis 1 Jan 1970
            //
            //
            $secondeLife = time() - strtotime($_POST['date']);
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
            header("Location: register.php");
        }
}
if (!empty($errors)){
    $_SESSION["errorsFormAuth"] = $errors;
    unset($_POST["pwd"]);
    unset($_POST["pwdConfirm"]);
    $_SESSION["dataFormAuth"] = $_POST;
    header("Location: register.php");
}