<?php

require 'model/game.php';
require 'model/collection.php';

require_once 'model/database.php';
require_once 'model/user.php';
require_once 'model/game.php';


if (isset($_GET['gameId'])){

    if (isset($_POST['removeGame']) && $_POST['removeGame'] == $_GET['gameId']){

        removeGame($_SESSION['userID'], $_GET['gameId']);
        header("Location: home");
    } elseif (isset($_POST['time_spent'])){
        $gameCollectionsInfo = getUserGameData($_SESSION['userID'], $_GET['gameId']);

        editGameTime($_SESSION['userID'],$_GET['gameId'],$gameCollectionsInfo['Heure_jouees'] + $_POST['time_spent']);
        header("Location: home");
    }
    else{
        $gameCollectionsInfo = getUserGameData($_SESSION['userID'], $_GET['gameId']);

        require 'view/gameUpdate.php';

    }



}
else{
    header("Location: home");
}

