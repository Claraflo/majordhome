<?php
session_start();

try{
    $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
}catch(Exception $e){
    die("Erreur SQL ".$e->getMessage());
}

if(count($_POST) == 4
    && !empty($_POST['title'])
    && !empty($_POST['priceEur'])
    && !empty($_POST['priceCent'])
    && !empty($_POST['description'])
){


    $title = trim($_POST['title']);
    $priceEur = trim($_POST['priceEur']);
    $priceCent = trim($_POST['priceCent']);
    $description = trim($_POST['description']);

    $errors = [];


    $data = $bdd->query("SELECT name FROM subscription WHERE name = '$title'");

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

    $price = $priceEur.$priceCent;

    if(empty($errors)) {

        $req = $bdd->prepare('INSERT INTO subscription(name, price, duration, description) VALUES(:title, :price, :duration, :description)');
        $req->execute([':title'=>$title,
            ':price'=>$price,
            ':duration'=>'365',
            ':description'=>$description
        ]);


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


