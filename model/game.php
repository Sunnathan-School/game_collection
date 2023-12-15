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
function addGame($pdo, $gameName, $gameDesc, $gameEditor, $gameRelease, $gameCoverUrl, $gameWebUrl, $platforms) {
    
    $stmt = $pdo->prepare("INSERT INTO JEUX (nom_jeux, description_jeux, editeur_jeux, date_sortie_jeux, couverture_url_jeux, site_url_jeux) 
                            VALUES (:gameName, :gameDesc, :gameEditor, :gameRelease, :gameCoverUrl, :gameWebUrl)");
    
    
    $stmt->bindParam(':gameName', $gameName);
    $stmt->bindParam(':gameDesc', $gameDesc);
    $stmt->bindParam(':gameEditor', $gameEditor);
    $stmt->bindParam(':gameRelease', $gameRelease);
    $stmt->bindParam(':gameCoverUrl', $gameCoverUrl);
    $stmt->bindParam(':gameWebUrl', $gameWebUrl);

    
    $stmt->execute();

  
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
function getGames() {

}