<?php
// Ici, vous pouvez gérer la logique de traitement du formulaire si nécessaire.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un jeu à la bibliothèque</title>
    <link href="styles/gameAdd.css" rel="stylesheet" />
</head>
<body>
    <header>
        <!-- Votre logo et navigation ici -->
    </header>

    <main>
        <h1>Ajouter un jeu à sa bibliothèque</h1>

        
        
        <form id="game-add-form" method="post">
        <?php

            // Include your database connection here
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

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_game'])) {
    
                // Assurez-vous que les clés de $_POST correspondent aux attributs "name" des champs de formulaire
                $gameName = $_POST['game_name'] ?? ''; // Utilisez l'opérateur de coalescence nulle pour éviter les avertissements
                $gameDesc = $_POST['game_desc'] ?? '';
                $gameEditor = $_POST['game_editor'] ?? '';
                $gameRelease = $_POST['game_release'] ?? '';
                $gameCoverUrl = $_POST['game_cover_url'] ?? '';
                $gameWebUrl = $_POST['game_web_url'] ?? '';
                $platforms = $_POST['platforms'] ?? []; // Pour les cases à cocher, cela garantit que vous obtenez un tableau, même s'il est vide
                
                // Appeler votre fonction pour ajouter le jeu
                addGame($pdo, $gameName, $gameDesc, $gameEditor, $gameRelease, $gameCoverUrl, $gameWebUrl, $platforms);
            }
            


            ?>


            <div class="form-group">
                <label for="game-name">Nom du jeu</label>
                <input type="text" id="game-name" name="game_name" required>
            </div>
            
            <div class="form-group">
                <label for="game-editor">Editeur du jeu</label>
                <input type="text" id="game-editor" name="game_editor" required>
            </div>
            
            <div class="form-group">
                <label for="game-release">Sortie du jeu</label>
                <input type="date" id="game-release" name="game_release" required>
            </div>
            
            <div class="form-group">
                <label>Plateformes</label>
                <div class="checkbox-group">
                    <div>
                        <input type="checkbox" id="playstation" name="platforms[]" value="Playstation">
                        <label for="playstation">Playstation</label>
                    </div>
                    <div>
                        <input type="checkbox" id="xbox" name="platforms[]" value="Xbox">
                        <label for="xbox">Xbox</label>
                    </div>
                    <div>
                        <input type="checkbox" id="nintendo" name="platforms[]" value="Nintendo">
                        <label for="nintendo">Nintendo</label>
                    </div>
                    <div>
                        <input type="checkbox" id="pc" name="platforms[]" value="PC">
                        <label for="pc">PC</label>
                    </div>
                </div>
            </div>

            
            <div class="form-group">
                <label for="game-description">Description du jeu</label>
                <textarea id="game-description" name="game_desc" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="cover-url">URL de la cover</label>
                <input type="url" id="cover-url" name="game_cover_url" required>
            </div>
            
            <div class="form-group">
                <label for="site-url">URL du site</label>
                <input type="url" id="site-url" name="game_web_url" required>
            </div>
            
            
            <button type="submit" id="submit-btn" name="add_game">AJOUTER LE JEU</button>

        </form>
    </main>

    <footer>
        Game Collection - 2023 - Tous droits réservés
    </footer>
</body>
</html>
