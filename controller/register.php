<?php
require_once 'model/user.php';
require_once 'model/database.php';

$alert_pwd_non_identique = false;
$alert_user_created = false;
if (
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['email']) &&
    isset($_POST['mdp']) &&
    isset($_POST['confMdp'])
){
    # TODO : verif si email déja prise
    if ($_POST['mdp'] != $_POST['confMdp']){
        $alert_pwd_non_identique = true;

    }else{
        addUser($_POST['prenom'],$_POST['nom'],$_POST['email'],$_POST['mdp']);
        $alert_user_created = true;
    }
}

require_once 'view/register.php';