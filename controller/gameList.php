<?php

if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}
$alert_add_game = false;
require_once 'model/collection.php';
require_once 'model/database.php';

if (isset($_POST['add_collection']) && isset($_POST['game_id'])){
    $gameId = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);


    addToCollection($gameId, $_SESSION['userID']);
    $alert_add_game = true;

}

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $games = searchGamesByName($_SESSION['userID'], htmlspecialchars($_POST['search']));
} else {
    $games = getGamesNotInCollection($_SESSION['userID']);
}

require 'view/gameList.php';

