<?php

require_once 'model/user.php';
require_once 'model/database.php';

if (
    isset($_POST['email']) &&
    isset($_POST['mdp'])
){
    // récup l'user avec l'email
    $connResult = connectUser($_POST['email'],$_POST['mdp']);
    if ($connResult){
        header("Location: home");
        exit();
    }else{
        echo "Problème lors de la connexion";
    }
}
require_once 'view/login.php';