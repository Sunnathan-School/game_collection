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
 * Recupère les jeux que l'utilisateur ne possède pas et qui correspondent a un texte donné
 *
 * @param string $searchTerm text a rechercher
 * @return array
 */
function searchGamesByName($userId, $searchTerm) {
    global $bdd;
    $games = [];
    $stmt = $bdd->prepare('SELECT * FROM JEUX WHERE Nom_Jeu LIKE :searchTerm AND JEUX.Id_Jeu NOT IN (SELECT COLLECTIONS.Id_Jeu FROM COLLECTIONS WHERE COLLECTIONS.Id_Utilisateur=:userId)');
    $searchTerm = "%{$searchTerm}%";
    $stmt->execute([':searchTerm'=>htmlspecialchars($searchTerm), 'userId'=>$userId]);

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

        $insertStmt->execute();
}


/**
 * Supprime un jeu de la collection du joueur
 *
 * @param int $userId Identifiant de l'utilisateur
 * @param int $gameId Identifiant du jeu à supprimer
 * @return void
 */
function removeGameFromCollection($userId, $gameId){
    global $bdd;
    $userId = htmlspecialchars($userId);
    $gameId = htmlspecialchars($gameId);
    $stmt = $bdd->prepare("DELETE FROM COLLECTIONS WHERE Id_Utilisateur = :userId AND Id_Jeu = :gameId");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':gameId', $gameId);
    $stmt->execute();
}