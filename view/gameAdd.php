<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type: text/html" content="charset=utf-8">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:;">
    <title>Ajouter un jeu à la bibliothèque</title>
    <link href="styles/gameAdd.css" rel="stylesheet" />
</head>
<body>
    <header>
        <!-- Ajouter header -->
    </header>

    <main>
        <h1>Ajouter un jeu à sa bibliothèque</h1>

        
        <!-- Récupère les infos pour ajouter un jeu à la BDD -->
        <form id="game-add-form" method="post">

            <!-- Mise en place du jeton CSRF -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">


            <div class="form-group">
                <label for="game-name">Nom du jeu</label>
                <input type="text" id="game-name" name="game_name" value="<?php echo isset($_POST['game_name']) ? htmlspecialchars($_POST['game_name'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="game-editor">Editeur du jeu</label>
                <input type="text" id="game-editor" name="game_editor" value="<?php echo isset($_POST['game_editor']) ? htmlspecialchars($_POST['game_editor'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="game-release">Sortie du jeu</label>
                <input type="date" id="game-release" name="game_release" value="<?php echo isset($_POST['game_release']) ? htmlspecialchars($_POST['game_release'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Plateformes</label>
                <div class="checkbox-group">
                    <div>
                        <input type="checkbox" id="playstation" name="platforms[]" value="Playstation" <?php echo isset($_POST['platforms']) && in_array('Playstation', $_POST['platforms']) ? 'checked' : ''; ?>>
                        <label for="playstation">Playstation</label>
                    </div>
                    <div>
                        <input type="checkbox" id="xbox" name="platforms[]" value="Xbox" <?php echo isset($_POST['platforms']) && in_array('Xbox', $_POST['platforms']) ? 'checked' : ''; ?>>
                        <label for="xbox">Xbox</label>
                    </div>
                    <div>
                        <input type="checkbox" id="nintendo" name="platforms[]" value="Nintendo" <?php echo isset($_POST['platforms']) && in_array('Nintendo', $_POST['platforms']) ? 'checked' : ''; ?>>
                        <label for="nintendo">Nintendo</label>
                    </div>
                    <div>
                        <input type="checkbox" id="pc" name="platforms[]" value="PC" <?php echo isset($_POST['platforms']) && in_array('PC', $_POST['platforms']) ? 'checked' : ''; ?>>
                        <label for="pc">PC</label>
                    </div>
                </div>
            </div>

            
            <div class="form-group">
                <label for="game-description">Description du jeu</label>
                <textarea id="game-description" name="game_desc"><?php echo isset($_POST['game_desc']) ? htmlspecialchars($_POST['game_desc'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="cover-url">URL de la cover</label>
                <input type="url" id="cover-url" name="game_cover_url" value="<?php echo isset($_POST['game_cover_url']) ? htmlspecialchars($_POST['game_cover_url'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="site-url">URL du site</label>
                <input type="url" id="site-url" name="game_web_url" value="<?php echo isset($_POST['game_web_url']) ? htmlspecialchars($_POST['game_web_url'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            </div>
            
            
            <button type="submit" id="submit-btn" name="add_game">AJOUTER LE JEU</button>

        </form>
    </main>

    <footer>
        <!-- Ajouter footer à la place -->
        Game Collection - 2023 - Tous droits réservés
    </footer>
</body>
</html>
