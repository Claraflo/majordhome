<?php
session_start ();

if(!empty($_POST['id'])) {

    $id = $_POST['id'];



    try{
        $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
    }catch(Exception $e){
        die("Erreur SQL ".$e->getMessage());
    }

    $req = $bdd->prepare("SELECT id FROM subscription WHERE id = $id");
    $req->execute(array());
    $subscription = $req->fetch();

    $count = $req->rowCount();

    if ($count == 0){
        $delete = "haie";
        $_SESSION['delete'] = $delete;
    }


    $data = $bdd->prepare("DELETE FROM subscription WHERE id = $id ");
    $data->execute(array());
    echo $id;
}


?>