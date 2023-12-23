<?php


// remplacer par la suite
function getDatabaseConnection() {
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
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}

$pdo = getDatabaseConnection();







/**
 * Récupere les jeux dans la collection du joueur
 *
 * @param  mixed $userId Identifiant de l'utilisateur
 * @return array
 */
function getCollectionGames(){


}



/**
 * Ajoute un jeu a la collection du joueur
 *
 * @param  int $gameId
 * @param  int $userId
 * @return void
 */

function addToCollection($pdo,$userId, $gameId){
    

    $checkStmt = $pdo->prepare("SELECT * FROM COLLECTIONS WHERE Id_Utilisateur = :userId AND Id_Jeu = :gameId");
    $checkStmt->bindParam(':userId', htmlspecialchars($userId), PDO::PARAM_INT);
    $checkStmt->bindParam(':gameId', htmlspecialchars($gameId), PDO::PARAM_INT);
    $checkStmt->execute();


    $insertStmt = $pdo->prepare("INSERT INTO COLLECTIONS (Id_Utilisateur, Id_Jeu, Heure_Jouees_Collection, Date_Ajout_Collection) VALUES (:userId, :gameId, 0, NOW())");
    $insertStmt->bindParam(':userId', htmlspecialchars($userId), PDO::PARAM_INT);
    $insertStmt->bindParam(':gameId', htmlspecialchars($gameId), PDO::PARAM_INT);
    $insertStmt->execute();
}


/**
 * supprimer le jeu de la collection du joueur
 *
 * @param  int $gameId
 * @param  int $userId
 * @return void
 */
function removeFromCollection($gameId,$userId){
    //meme fonction que dans game.php / removeGame()
}







