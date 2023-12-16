<?php

// Vérifiez le jeton CSRF
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Connexion à la base de donnée partira par la suite


$host = 'localhost';
$db = 'jeux'; // This is your database name
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
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


//vérifier que le POST a été fait avant d'ajouter un jeu

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_game']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

    $gameName = $_POST['game_name'] ?? '';
    $gameDesc = $_POST['game_desc'] ?? '';
    $gameEditor = $_POST['game_editor'] ?? '';
    $gameRelease = $_POST['game_release'] ?? '';
    $gameCoverUrl = $_POST['game_cover_url'] ?? '';
    $gameWebUrl = $_POST['game_web_url'] ?? '';
    $platforms = $_POST['platforms'] ?? []; // Permet d'avoir plusieurs cases à cocher en metant un tbaleau

    // Appeler votre fonction pour ajouter le jeu dans la BDD
    addGame($pdo, $gameName, $gameDesc, $gameEditor, $gameRelease, $gameCoverUrl, $gameWebUrl, $platforms);
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


function addGame($pdo, $gameName, $gameDesc, $gameEditor, $gameRelease, $gameCoverUrl, $gameWebUrl, $platforms) {

    $gameName = filter_var($gameName, FILTER_SANITIZE_STRING);
    $gameDesc = filter_var($gameDesc, FILTER_SANITIZE_STRING);
    $gameEditor = filter_var($gameEditor, FILTER_SANITIZE_STRING);
    $gameCoverUrl = filter_var($gameCoverUrl, FILTER_VALIDATE_URL);
    $gameWebUrl = filter_var($gameWebUrl, FILTER_VALIDATE_URL);
    
    $stmt = $pdo->prepare("INSERT INTO JEUX (nom_jeux, description_jeux, editeur_jeux, date_sortie_jeux, couverture_url_jeux, site_url_jeux) 
                            VALUES (:gameName, :gameDesc, :gameEditor, :gameRelease, :gameCoverUrl, :gameWebUrl)");
    
    
    $stmt->bindParam(':gameName', $gameName);
    $stmt->bindParam(':gameDesc', $gameDesc);
    $stmt->bindParam(':gameEditor', $gameEditor);
    $stmt->bindParam(':gameRelease', $gameRelease);
    $stmt->bindParam(':gameCoverUrl', $gameCoverUrl);
    $stmt->bindParam(':gameWebUrl', $gameWebUrl);

    
    $stmt->execute();

    $gameId = $pdo->lastInsertId();

    // Insérer les plateformes dans la table appartenir
    foreach ($platforms as $platform) {
   
        $platform = filter_var($platform, FILTER_SANITIZE_STRING);

        // Recherche de l'ID de la plateforme
        $platformStmt = $pdo->prepare("SELECT Id_plateforme FROM PLATEFORME WHERE nom_plateforme = :platform");
        $platformStmt->execute([':platform' => $platform]);
        $platformRow = $platformStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($platformRow) {
            $platformId = $platformRow['Id_plateforme'];
            
            // Insertion dans la table appartenir
            $appartenirStmt = $pdo->prepare("INSERT INTO appartenir (Id_jeux, Id_plateforme, Num_odre_plateforme) VALUES (:gameId, :platformId, 1)"); 
            $appartenirStmt->execute([':gameId' => $gameId, ':platformId' => $platformId]);
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
function getGames() {

}