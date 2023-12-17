

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-Content-Type-Options" content="nosniff">
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:;">
<title>Game Collection</title>
<link href="styles/gameList.css" rel="stylesheet" />
</head>
<body>
<header>
    <!-- Your header here -->
</header>

<main>
    <h1>Ajouter un jeu à sa bibliothèque</h1>
    <form id="search-form" method="post">
        <div id="search-container">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input id="search-input" type="text" name="search" placeholder="Rechercher un jeu">
            <button type="submit" id="search-btn">
                RECHERCHER
            </button>     
        </div>

    </form>
 

    <section id="game-library">
        <h2>Mes jeux</h2>
        <div class="game-container">
        
        <?php
            
            foreach ($games as $game) {
                echo "<form method='post' class='game-form'>";
                echo "<input type='hidden' name='game_id' value='" . htmlspecialchars($game['Id_jeux']) . "'>";
                echo "<div class='game' style='background-image: url(\"" . htmlspecialchars($game['couverture_url_jeux']) . "\");'>";
                echo "<div class='game-overlay'></div>";
                echo "<h3>" . htmlspecialchars($game['nom_jeux']) . "</h3>";
                echo "<p>" . htmlspecialchars($game['editeur_jeux']) . "</p>";
                echo "<button type='submit' name='add_collection'>AJOUTER À LA BIBLIOTHÈQUE</button>";
                echo "</div>";
                echo "</form>";
            }
            ?>

        </div>
    </section>
</main>

<footer>
    <!-- Your footer here -->
</footer>

</body>
</html>
