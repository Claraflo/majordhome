<?php
session_start ();

if(!empty($_POST['id'])) {

    $id = $_POST['id'];



    try{
        $bdd = new PDO("mysql:host=localhost;dbname=subscription;port=3306", "root", "root");
    }catch(Exception $e){
        die("Erreur SQL ".$e->getMessage());
    }


    $req = $bdd->prepare("UPDATE subscription set status =:status WHERE id =:id;");
    $req->execute([
        ':status'=>-1,
        ':id'=>$id
    ]);

}



?>