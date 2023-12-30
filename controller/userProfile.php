<?php
if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}
require_once "model/user.php";
require_once "model/database.php";

$userInfo = getUserData($_SESSION['userID']);
if (isset($_POST['disconnect']) && $_POST['disconnect'] == 1){
    session_unset();
    header("Location: login");
}elseif (isset($_POST['remove']) && $_POST['remove'] == 1){
    removeUser($_SESSION['userID']);
    header("Location: login");
}elseif (isset($_POST['edit']) && $_POST['edit'] == 1){
    if (isset($_POST['nom'])
        && isset($_POST['prenom'])
        && isset($_POST['mail'])
        && isset($_POST['password'])
        && isset($_POST['password_conf'])){
        if (isset($_POST['password']) == isset($_POST['password_conf'])){
            editUser($_SESSION['userID'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], password_hash($_POST['password'], PASSWORD_DEFAULT));
            $userInfo = getUserData($_SESSION['userID']);
        }
    }// TODO: quand utilisateur change d'info sauf MDP ==> ne pas changer le mdp !!!
}
require_once "view/userProfile.php";