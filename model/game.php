<?php


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
 * @param  integer $gameId
 * @return void
 */
function removeGame($gameId){}

/**
 * Modifie un jeu
 *
 * @param  int $gameId Identifiant du jeu
 * @param  string $gameName Nom du jeu
 * @param  string $gameDesc Description du jeu
 * @param  string $gameEditor Editeur du jeur
 * @param  date $gameRelease Date de sortie du jeu
 * @param  string $gameCoverUrl Url de la couverture du jeu
 * @param  string $gameWebUrl Url du site web du jeu 
 * @param  array $platform Liste des plateforms du jeu
 * @return void
 */
function editGame($gameId, $gameName, $gameDesc, $gameEditor, $gameRelease, $gameCoverUrl, $gameWebUrl,$platform){}


$gameId = isset($_GET['id']) ? $_GET['id'] : null;
//$userId = $_SESSION['user_id'] ?? null; 


/**
 * Récupère un jeu
 *
 * @return array
 */
<<<<<<< Updated upstream
function getGames(){}
=======

function getGames() {
    

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
>>>>>>> Stashed changes
