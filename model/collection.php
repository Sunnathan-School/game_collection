<?php

session_start();

// Vérifiez le jeton CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


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
    $userId = 1; 

    addToCollection($pdo,$userId,$gameId);
    
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['search'])) {
    
    $searchTerm = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $games = searchGamesByName($pdo, $searchTerm);
} else {
    
    $games = getCollectionGames($pdo);
}


if (isset($_POST['add_game']) && isset($_POST['game_id'])) {
    $gameId = $_POST['game_id'];
    addToCollection($pdo, $gameId);
    $_SESSION['success_message'] = "Jeu bien ajouté à la collection.";
     
}


/**
 * Récupere les jeux dans la collection du joueur
 *
 * @param  mixed $userId Identifiant de l'utilisateur
 * @return array
 */
function getCollectionGames($userId){

}

/**
 * Ajoute un jeu a la collection du joueur
 *
 * @param  int $gameId
 * @param  int $userId
 * @return void
 */
function addToCollection($pdo,$userId, $gameId){
    
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

