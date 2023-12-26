<?php

if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}

require_once 'model/game.php';
require_once 'model/database.php';

if (isset($_POST['game_name']) &&
    isset($_POST['game_desc']) &&
    isset($_POST['game_editor']) &&
    isset($_POST['game_release']) &&
    isset($_POST['game_cover_url']) &&
    isset($_POST['game_web_url']) &&
    isset($_POST['platforms'])
) {
    // Validation de la date
    $gameRelease = DateTime::createFromFormat('Y-m-d', $_POST['game_release']) ? $_POST['game_release'] : 1-11-1111;

    addGame($_POST['game_name'], $_POST['game_desc'], $_POST['game_editor'], $gameRelease, $_POST['game_cover_url'], $_POST['game_web_url'], $_POST['platforms']);

    header('Location: games');
    exit();
}

require 'view/gameAdd.php';