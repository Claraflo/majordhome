<?php
session_start();

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}

$id = $_SESSION['id'];

if(count($_POST) == 11
    && !empty($_POST['title'])
    && !empty($_POST['priceEur'])
    && !empty($_POST['description'])
    && !empty($_POST['week'])
    && !empty($_POST['time'])
    && !empty($_POST['timeStart'])
    && !empty($_POST['timeEnd'])
){




    $title = trim($_POST['title']);
    $priceEur = trim($_POST['priceEur']);
    $priceCent = trim($_POST['priceCent']);
    $years = trim($_POST['years']);
    $months = trim($_POST['months']);
    $days = trim($_POST['days']);
    $description = trim($_POST['description']);
    $week = trim($_POST['week']);
    $time = trim($_POST['time']);
    $timeStart = trim($_POST['timeStart']);
    $timeEnd = trim($_POST['timeEnd']);
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
        $errors['priceCent'] = "Les centimes indiqués ne sont pas valides. Il est obligatoire d'y insérer 2 chiffres.";
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

    if(!empty($week) && !preg_match('/^[1-7]$/', $week)) {
        $errors['week'] = "Le nombre de jours par semaine n'est pas valide.";
    }

    if(!empty($time) && !preg_match('/^[0-9]+$/', $time)) {
        $errors['time'] = "Le nombre d'heures par mois n'est pas valide.";
    }

    if(!empty($timeStart) && !preg_match('/^[0-9]{1,2}$/', $timeStart)) {
        $errors['timeStart'] = "L'heure de début n'est pas valide.";
    }

    if(!empty($timeEnd) && !preg_match('/^[0-9]{1,2}$/', $timeEnd)) {
        $errors['timeEnd'] = "L'heure de fin n'est pas valide.";
    }


    if ($timeStart >= $timeEnd && ($timeStart != 24 && $timeEnd != 24)){
        $errors['timeStartEnd'] = "L'heure de début ne peut pas être supérieur ou la même que l'heure de fin.";
    }

    $price = $priceEur.$priceCent;


    if(empty($errors)) {

        $req = $bdd->prepare("UPDATE subscription set name =:title, price =:price, description =:description, years =:years, months =:months, days =:days, week =:week, time =:time, timeStart =:timeStart, timeEnd =:timeEnd WHERE id =:id;");
        $req->execute([':title'=>$title,
            ':price'=>$price,
            ':description'=>$description,
            'years'=>$years,
            'months'=>$months,
            'days'=>$days,
            'week'=>$week,
            'time'=>$time,
            'timeStart'=>$timeStart,
            'timeEnd'=>$timeEnd,
            'id'=>$id
        ]);


        $confirm[] = "L'abonnement a bien été modifié";
        $_SESSION["confirmFormAuth"] = $confirm;
        header("Location: subscription.php");
    }

    if (!empty($errors)){
        $_SESSION["errorsFormAuth"] = $errors;
        $_SESSION["dataFormAuth"] = $_POST;
        header("Location: modificationSubscription.php?id=$id");
    }

}else{
    $Hack[] = "Tentative de hack detectée";
    $_SESSION["hackFormAuth"] = $Hack;
    header("Location: modificationSubscription.php?id=$id");
}


