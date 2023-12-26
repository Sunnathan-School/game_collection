<?php

/**
 * Récupere les jeux dans la collection du joueur
 *
 * @param  mixed $userId Identifiant de l'utilisateur
 * @return array
 */

function getGamesNotInCollection($userId){
    global $bdd;

    $games = [];
    $sql = "SELECT JEUX.* FROM JEUX WHERE JEUX.Id_Jeu NOT IN (SELECT COLLECTIONS.Id_Jeu FROM COLLECTIONS WHERE COLLECTIONS.Id_Utilisateur=:userId)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':userId'=>$userId]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($games, $row);
    }

    return $games;  
}

/**
 * Searches for games in the player's collection by name.
 *
 * @param string $searchTerm text a rechercher
 * @return array
 */
function searchGamesByName($searchTerm) {
    global $bdd;
    $games = [];
    $stmt = $bdd->prepare('SELECT * FROM JEUX WHERE Nom_Jeu LIKE :searchTerm');
    $searchTerm = "%{$searchTerm}%";
    $stmt->execute([':searchTerm'=>htmlspecialchars($searchTerm)]);

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

function addToCollection($gameId, $userId){
    global $bdd;

        $insertStmt = $bdd->prepare("INSERT INTO COLLECTIONS (Id_Utilisateur, Id_Jeu, Heure_Jouees_Collection, Date_Ajout_Collection) VALUES (:userId, :gameId, 0, NOW())");
        $insertStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $insertStmt->bindParam(':gameId', $gameId, PDO::PARAM_INT);

        if ($insertStmt->execute()) {
            echo "Jeu bien ajouté à la collection.";
        } else {
            echo "Erreur lors de l'ajout du jeu.";
        }
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







