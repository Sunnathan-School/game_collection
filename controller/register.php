<?php
require_once 'model/user.php';
require_once 'model/database.php';


if (
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['email']) &&
    isset($_POST['mdp']) &&
    isset($_POST['confMdp'])
){
    if ($_POST['mdp'] != $_POST['confMdp']){
        echo 'Mot de passe non identique';
    }else{
        addUser($_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['mdp']);
        echo 'Utilisateur ajouté avec succès !';
    }
}

require_once 'view/register.php';