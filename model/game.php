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

/**
 * Récupère tous les jeux
 *
 * @return void
 */
function getGames() {}