<?php
session_start();

if(count($_POST) == 3
    && !empty($_POST['title'])
    && !empty($_POST['price'])
    && !empty($_POST['description'])
){


    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    $errors = [];


    if (preg_match('/^\d+(\.\d{2})?$/', $price) == '0') {
        $errors['price'] = "Le prix n'est pas valide.";
    }else{
        $priceTab = explode(".", $price);
        $price = $priceTab[0].$priceTab[1];
    }

    if(empty($errors)) {
        $confirm[] = "L'abonnement a bien été créé";
        $_SESSION["confirmFormAuth"] = $confirm;
        header("Location: subscription.php");
    }

    if (!empty($errors)){
        $_SESSION["errorsFormAuth"] = $errors;
        $_SESSION["dataFormAuth"] = $_POST;
        header("Location: createSubscription.php");
    }

}else{
    $Hack[] = "Tentative de hack detectée";
    $_SESSION["hackFormAuth"] = $Hack;
    header("Location: createSubscription.php");
}


