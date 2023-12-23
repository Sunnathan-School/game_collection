<?php



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
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
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
    //meme fonction que dans collection.php / addToCollection()
}

/**
 * Supprime un jeu
 *
 * @param PDO $pdo L'objet de connexion à la base de données
 * @param int $userId Identifiant de l'utilisateur
 * @param int $gameId Identifiant du jeu à supprimer
 * @return void
 */

function removeGame($pdo){

    //à suppriemr par la suite

    $gameId=1;
    $userId=1;
   

    $stmt = $pdo->prepare("DELETE FROM COLLECTIONS WHERE Id_Utilisateur = :userId AND Id_Jeu = :gameId");
    $stmt->bindParam(':userId', htmlspecialchars($userId), PDO::PARAM_INT);
    $stmt->bindParam(':gameId', htmlspecialchars($gameId), PDO::PARAM_INT);
    $stmt->execute();
        
        
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

function editGameTime($pdo,$gameTimePlay){

    //à suppriemr par la suite

    $gameId=1;
    $userId=1;
    $pdo = getDatabaseConnection();



    $stmt = $pdo->prepare("UPDATE COLLECTIONS SET Heure_Jouees_Collection = :gameTimePlay WHERE Id_Jeu = :gameId AND Id_Utilisateur = :userId");
    $stmt->bindParam(':gameTimePlay', htmlspecialchars($gameTimePlay), PDO::PARAM_INT);
    $stmt->bindParam(':gameId', htmlspecialchars($gameId), PDO::PARAM_INT);
    $stmt->bindParam(':userId', htmlspecialchars($userId), PDO::PARAM_INT);
    $stmt->execute();
    
  
}




/**
 * Récupère un jeu
 * @param PDO $pdo L'objet de connexion à la base de données
 * @param int $gameId Identifiant du jeu
 * @param int $userId Identifiant de l'utilisateur
 * @return array
 */

function getGame($pdo) {

    //à suppriemr par la suite

    $gameId=1;
    $userId=1;
 

        
    $stmt = $pdo->prepare("
        SELECT j.*, c.Heure_Jouees_Collection 
        FROM JEUX j 
        LEFT JOIN COLLECTIONS c ON j.Id_Jeu = c.Id_Jeu 
        WHERE j.Id_Jeu = :gameId AND c.Id_Utilisateur = :userId
    ");
    
    $stmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
        

}

