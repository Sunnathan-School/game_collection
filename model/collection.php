<?php

session_start();




// remplacer par la suite
$host = 'localhost';
$db = 'jeux'; 
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}





if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_collection']) && isset($_POST['game_id'])){
    $gameId = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);

    //ajoute user_id plus tard
    //$userId = $_POST['user_id']; 

    addToCollection($pdo,$gameId);
    
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['search'])) {
    
    $searchTerm = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $games = searchGamesByName($pdo, $searchTerm);
} else {
    
    $games = getCollectionGames($pdo);
}



/**
 * Récupere les jeux dans la collection du joueur
 *
 * @param  mixed $userId Identifiant de l'utilisateur
 * @return array
 */


function getCollectionGames($pdo){
    $games = [];

    /* pas logique d'avoir l'userId à revoir
    mettre userId plus tard*/
    $userId=2;

    
    $stmt = $pdo->prepare('SELECT j.* FROM JEUX j LEFT JOIN collectionner c ON j.id_jeux = c.Id_jeux AND c.Id_users = :userId WHERE c.Id_jeux IS NULL');
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($games, $row);
    }

    return $games;  
}

/**
 * Searches for games in the player's collection by name.
 *
 * @param PDO $pdo PDO connection object.
 * @param string $searchTerm The term to search for in game names.
 * @return array An array of games matching the search term.
 */

function searchGamesByName($pdo, $searchTerm) {
    $games = [];
    $stmt = $pdo->prepare('SELECT * FROM JEUX WHERE nom_jeux LIKE :searchTerm');
    $searchTerm = "%{$searchTerm}%";
    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($games, $row);
    }

    return $games;
}


/**
 * Ajoute un jeu a la collection du joueur
 *
 * @param  int $gameId
 * @param  int $userId
 * @return void
 */


//rajouter $userId plus tard dans paramètre



function addToCollection($pdo, $gameId){
    $userId=1;
    // D'abord, vérifier si l'enregistrement existe déjà
    $checkStmt = $pdo->prepare("SELECT * FROM collectionner WHERE Id_users = :userId AND Id_jeux = :gameId");
    $checkStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $checkStmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        // L'enregistrement existe déjà, donc ne rien faire ou afficher un message
        
        return;
    }

    // Si l'enregistrement n'existe pas, procéder à l'insertion
    try {
        $insertStmt = $pdo->prepare("INSERT INTO collectionner (Id_users, Id_jeux, heures_jouees_collection, date_ajout_collection) VALUES (:userId, :gameId, 0, NOW())");
        $insertStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $insertStmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);

        if ($insertStmt->execute()) {
            echo "Jeu bien ajouté à la collection.";
        } else {
            echo "Erreur lors de l'ajout du jeu.";
        }
    } catch (PDOException $e) {
        echo "Erreur de la base de données : " . $e->getMessage();
    }
}
    


/**
 * supprimer le jeu de la collection du joueur
 *
 * @param  int $gameId
 * @param  int $userId
 * @return void
 */
function removeFromCollection($gameId,$userId){}

