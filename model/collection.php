<?php


/**
 * Récupere les jeux dans la collection du joueur
 *
 * @param  mixed $userId Identifiant de l'utilisateur
 * @return array
 */


function getCollectionGames($pdo){
    $games = [];
    $userId=1;
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

