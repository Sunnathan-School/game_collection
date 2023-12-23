<?php

require 'model\game.php';
require 'model\collection.php';
require 'view\gameUpdate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_time'])) {
    $gameId = filter_var($_GET['game_id'], FILTER_SANITIZE_STRING);
    $gameTimePlay = filter_var($_POST['time_spent'], FILTER_SANITIZE_STRING);

    editGameTime($pdo,$gameTimePlay);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_game'])) {
    $gameId = filter_var($_GET['game_id'], FILTER_SANITIZE_STRING); 

    removeGame($pdo,$gameId);
}




if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['search'])) {
    
    $searchTerm = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $games = searchGamesByName($pdo,$searchTerm);
} else {
    
    $games = getGame($pdo);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_collection']) && isset($_POST['game_id'])){
    $gameId = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);
    addToCollection($pdo,$userId,$gameId);
    
}



if (isset($_POST['add_game']) && isset($_POST['game_id'])) {
    $gameId = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);
    addToCollection($pdo, $gameId,$userId);
    $_SESSION['success_message'] = "Jeu bien ajouté à la collection.";
     
}

?>