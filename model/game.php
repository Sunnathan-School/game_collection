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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_time'])) {
    $gameId = $_GET['game_id'];
    $userId = 1; // Remplacez par l'ID de l'utilisateur actuel récupéré d'une session ou d'une autre méthode d'authentification
    $gameTimePlay = $_POST['time_spent'];

    editGameTime($pdo, $gameId,$userId, $gameTimePlay);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_game'])) {
    $userId = 1; 
    $gameId = $_GET['game_id']; 

    removeGameFromCollection($pdo, $userId, $gameId);
}

/**
 * Ajoute un jeu
 *
 * @param  string $gameName Nom du jeu
 * @param  string $gameDesc Description du jeu
 * @param  string $gameEditor Editeur du jeur
 * @param  date $gameRelease Date de sortie du jeu
 * @param  string $gameCoverUrl Url de la couverture du jeu
 * @param  string $gameWebUrl Url du site web du jeu 
 * @param  array $platform Liste des plateforms du jeu
 * @return void
 */
function addGame($gameName, $gameDesc, $gameEditor, $gameRelease, $gameCoverUrl, $gameWebUrl,$platform){
    
}

/**
 * Supprime un jeu
 *
 * @param PDO $pdo L'objet de connexion à la base de données
 * @param int $userId Identifiant de l'utilisateur
 * @param int $gameId Identifiant du jeu à supprimer
 * @return void
 */

function removeGame($pdo, $userId, $gameId){
    try {
        $stmt = $pdo->prepare("DELETE FROM collectionner WHERE Id_users = :userId AND Id_jeux = :gameId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount()) {
            echo "Jeu supprimé de la collection avec succès.";
        } else {
            echo "Aucun jeu trouvé à supprimer.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression du jeu : " . $e->getMessage();
    }
}



/**
 * Modifie temps passé sur un jeu
 *
 * @param PDO $pdo L'objet de connexion à la base de données
 * @param int $gameId Identifiant du jeu
 * @param int $userId Identifiant de l'utilisateur
 * @param int $gameTimePlay Temps passé sur le jeu
 * @return void
 */
function editGameTime($pdo, $gameId,$userId, $gameTimePlay) {


    try {
        $stmt = $pdo->prepare("UPDATE collectionner SET heures_jouees_collection = :gameTimePlay WHERE Id_jeux = :gameId AND Id_users = :userId");
        $stmt->bindParam(':gameTimePlay', $gameTimePlay, PDO::PARAM_INT);
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount()) {
            echo "Temps de jeu mis à jour avec succès.";
        } else {
            echo "Aucune mise à jour n'a été effectuée. Vérifiez que le jeu existe dans la collection de l'utilisateur.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour du temps de jeu : " . $e->getMessage();
    }
}




/**
 * Récupère un jeu
 *
 * @return array
 */

function getGames() {

    $gameId = isset($_GET['id']) ? $_GET['id'] : null;
    //$userId = $_SESSION['user_id'] ?? null; 
    

    $game = null;
    $timeSpent = 0;

    //à supprimer par la suite
    $userId=1;

    if ($gameId && $userId) {
        
        $stmt = $pdo->prepare("
            SELECT j.*, c.heures_jouees_collection 
            FROM JEUX j 
            LEFT JOIN collectionner c ON j.Id_jeux = c.Id_jeux 
            WHERE j.Id_jeux = :gameId AND c.Id_users = :userId
        ");
        
        $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    } else {
        echo "Aucun identifiant de jeu ou d'utilisateur fourni.";
        exit;
    }

}
