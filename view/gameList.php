

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Collection</title>
<link href="styles/gameList.css" rel="stylesheet" />
</head>
<body>
<header>
    <!-- Your logo and navigation here -->
</header>

<main>
    <h1>Ajouter un jeu à sa bibliothèque</h1>
    <form id="search-form" method="post">
        <div id="search-container">

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

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_collection']) && isset($_POST['game_id'])){
                $gameId = $_POST['game_id'];

                //ajoute user_id plus tard
                //$userId = $_POST['user_id']; 

                addToCollection($pdo,$gameId);
                
                
            }

            


            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['search'])) {
                
                $searchTerm = $_POST['search'];
                $games = searchGamesByName($pdo, $searchTerm);
            } else {
                
                $games = getCollectionGames($pdo);
            }


            
            foreach ($games as $game) {
                echo "<form method='post' class='game-form'>";
                echo "<input type='hidden' name='game_id' value='" . $game['Id_jeux'] . "'>";
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
    Game Collection - 2023 - Tous droits réservés
</footer>

<script>
// Add any JavaScript here
</script>
</body>
</html>
