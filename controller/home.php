<?php

if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}
require_once 'model/database.php';
require_once 'model/user.php';

$userName = getUserName($_SESSION['userID']);
$userGamesList = getUserGames($_SESSION['userID']);

//var_dump($userGamesList);
// TODO: gérer si joueur n'a pas de jeu

require_once './view/home.php';

