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
 * @param  array $platforms Liste des plateforms du jeu
 * @return void
 */
function addGame($gameName, $gameDesc, $gameEditor, $gameRelease, $gameCoverUrl, $gameWebUrl, $platforms) {
    global $bdd;

    $gameName = htmlspecialchars($gameName);
    $gameDesc = htmlspecialchars($gameDesc);
    $gameEditor = htmlspecialchars($gameEditor);
    $gameCoverUrl = filter_var($gameCoverUrl, FILTER_VALIDATE_URL);
    $gameWebUrl = filter_var($gameWebUrl, FILTER_VALIDATE_URL);


    $stmt = $bdd->prepare("INSERT INTO JEUX (Nom_Jeu, Desc_Jeu, Editeur_Jeu, Date_Sortie_Jeu, Couverture_Jeu, Site_Jeu) VALUES 
                                            (:gameName, :gameDesc, :gameEditor, :gameRelease, :gameCoverUrl, :gameWebUrl)");

    $stmt->execute([':gameName'=>$gameName,
        ':gameDesc'=> $gameDesc,
        ':gameEditor'=> $gameEditor,
        ':gameRelease'=> $gameRelease,
        ':gameCoverUrl'=> $gameCoverUrl,
        ':gameWebUrl'=> $gameWebUrl]);

    $gameId = $bdd->lastInsertId();
    $numOrdre = 1;
    // Insérer les plateformes dans la table appartenir
    foreach ($platforms as $platform) {
   
        $platform = filter_var($platform, FILTER_SANITIZE_STRING);

        // Recherche de l'ID de la plateforme
        $platformStmt = $bdd->prepare("SELECT Id_plateforme FROM PLATEFORME WHERE Nom_Plateforme = :platform");
        $platformStmt->execute([':platform' => $platform]);
        $platformRow = $platformStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($platformRow) {
            $platformId = $platformRow['Id_plateforme'];
            
            // Insertion dans la table appartenir
            $appartenirStmt = $bdd->prepare("INSERT INTO DISPONIBLE (Id_plateforme, Id_Jeu, N_Ordre_Plateforme) VALUES (:platformId,:gameId, :nOrdre)");
            $appartenirStmt->execute([':gameId' => $gameId, ':platformId' => $platformId, ':nOrdre' => $numOrdre]);
            $numOrdre++;
        }
    }
}

/**
 * Modifie temps passé sur un jeu pour un utilisateur
 *
 * @param int $gameId Identifiant du jeu
 * @param int $userId Identifiant de l'utilisateur
 * @param int $gameTimePlay Temps passé sur le jeu
 * @return void
 */
function editGameTime($userId, $gameId, $gameTimePlay){
    global $bdd;
    $stmt = $bdd->prepare("UPDATE COLLECTIONS SET Heure_Jouees_Collection = :gameTimePlay WHERE Id_Jeu = :gameId AND Id_Utilisateur = :userId");

    $timePlayInHour = sprintf('%02d:%02d:%02d', $gameTimePlay, 0, 0);
    $stmt->bindParam(':gameTimePlay', $timePlayInHour);
    $stmt->bindParam(':gameId', $gameId);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
}

/**
 * Récupère les jeux que possède l'utilisateur
 * @param $userId
 * @return array|false
 */
function getUserGames($userId){
    global $bdd;
    $sql = "SELECT jeux.Id_Jeu,jeux.Nom_Jeu,jeux.Couverture_Jeu, GROUP_CONCAT(plateforme.Nom_Plateforme) AS Plateformes, HOUR(collections.Heure_Jouees_Collection) AS Heure_jouees FROM collections 
INNER JOIN jeux ON collections.Id_Jeu=jeux.Id_Jeu
LEFT JOIN disponible ON jeux.Id_Jeu=disponible.Id_Jeu
LEFT JOIN plateforme ON disponible.Id_plateforme=plateforme.Id_plateforme
WHERE collections.Id_Utilisateur=:userId
GROUP BY jeux.Id_Jeu";

    $stmt = $bdd->prepare($sql);
    $stmt->execute(['userId'=>$userId]);
    return $stmt->fetchAll();
}

/**
 * Récupère les informations conernant le temp de jeu de l'utilisateur
 * @param $userId
 * @param $gameId
 * @return mixed
 */
function getUserGameData($userId, $gameId){
    global $bdd;
    $sql = "SELECT jeux.Id_Jeu,jeux.Nom_Jeu,jeux.Couverture_Jeu, jeux.Desc_Jeu, HOUR(collections.Heure_Jouees_Collection) AS Heure_jouees FROM collections 
INNER JOIN jeux ON collections.Id_Jeu=jeux.Id_Jeu
LEFT JOIN disponible ON jeux.Id_Jeu=disponible.Id_Jeu
LEFT JOIN plateforme ON disponible.Id_plateforme=plateforme.Id_plateforme
WHERE collections.Id_Utilisateur=:userId AND collections.Id_Jeu=:gameId";

    $stmt = $bdd->prepare($sql);
    $stmt->execute(['userId'=>$userId, 'gameId'=>$gameId]);
    return $stmt->fetch();
}
