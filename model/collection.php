<?php

/**
 * Récupere les jeux dans la collection du joueur
 *
 * @param  mixed $userId Identifiant de l'utilisateur
 * @return array
 */
function getCollectionGames($userId){
    global $bdd;
    $games = [];
    
    $stmt = $bdd->prepare('SELECT jeux.* FROM jeux WHERE jeux.Id_Jeu NOT IN (SELECT collections.Id_Jeu FROM collections WHERE collections.Id_Utilisateur=:userId);');
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
function searchGamesByName($searchTerm) {
    global $bdd;
    $games = [];
    $stmt = $bdd->prepare('SELECT * FROM JEUX WHERE Nom_Jeu LIKE :searchTerm');
    $searchTerm = "%{$searchTerm}%";
    $stmt->bindParam(':searchTerm', htmlspecialchars($searchTerm), PDO::PARAM_STR);
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
function removeFromCollection($gameId,$userId){}

