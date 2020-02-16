<?php
session_start();

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}

if(count($_POST) == 7
    && !empty($_POST['title'])
    && !empty($_POST['priceEur'])
    && !empty($_POST['priceCent'])
    && !empty($_POST['description'])
){

    $id = $_SESSION['id'];
    unset($_SESSION['id']);

    $title = trim($_POST['title']);
    $priceEur = trim($_POST['priceEur']);
    $priceCent = trim($_POST['priceCent']);
    $years = trim($_POST['years']);
    $months = trim($_POST['months']);
    $days = trim($_POST['days']);
    $description = trim($_POST['description']);
    $id = trim($id);

    $errors = [];


    $data = $bdd->query("SELECT name FROM subscription WHERE name = '$title' && id !='$id'");

    foreach ($data->fetchAll() as $key => $subscription) {
        $count = $data->rowCount();

        if ($count != 0) {
            $errors['title'] = "Un abonnement avec un titre similaire existe déjà";
        }
    }


    if(!preg_match('/^[0-9]+$/', $priceEur)) {
        $errors['priceEur'] = "Les euros indiqués ne sont pas valides.";
    }

    if(!preg_match('/^[0-9][0-9]$/', $priceCent)) {
        $errors['priceCent'] = "Les centimes indiqués ne sont pas valides.";
    }

    if(!empty($years) && !preg_match('/^[0-9]{1,2}$/', $years)) {
        $errors['years'] = "Le nombre d'années n'est pas valide.";
    }

    if(!empty($months) && !preg_match('/^[0-9]{1,2}$/', $months)) {
        $errors['months'] = "Le nombre de mois n'est pas valide.";
    }

    if(!empty($days) && !preg_match('/^[0-9]+$/', $days)) {
        $errors['days'] = "Le nombre de jours n'est pas valide.";
    }

    if (empty($years) && empty($months) && (empty($days) || $days == 0)){
        $errors['days'] = "L'abonnement doit avoir une durée minimum d'un jour.";
    }

    $price = $priceEur.$priceCent;

    if(empty($errors)) {

        $req = $bdd->prepare("UPDATE subscription set name =:title, price =:price, description =:description, years =:years, months =:months, days =:days WHERE id =:id;");
        $req->execute([':title'=>$title,
            ':price'=>$price,
            ':description'=>$description,
            'years'=>$years,
            'months'=>$months,
            'days'=>$days,
            'id'=>$id
        ]);


        $confirm[] = "L'abonnement a bien été modifié";
        $_SESSION["confirmFormAuth"] = $confirm;
        header("Location: subscription.php");
    }

    if (!empty($errors)){
        $_SESSION["errorsFormAuth"] = $errors;
        $_SESSION["dataFormAuth"] = $_POST;
        header("Location: modificationSubscription.php?=$id");
    }

}else{
    $Hack[] = "Tentative de hack detectée";
    $_SESSION["hackFormAuth"] = $Hack;
    header("Location: modificationSubscription.php?=$id");
}


