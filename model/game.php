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

/**
 * Récupère tous les jeux
 *
 * @return void
 */
function getGames(){}