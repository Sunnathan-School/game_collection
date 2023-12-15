<?php
// Replace with your database connection details
$host = 'localhost';
$db   = 'jeux';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Game Collection</title>
<link href="styles\gameList.css" rel="stylesheet" />
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
  
                $stmt = $pdo->query('SELECT * FROM JEUX');
                while ($row = $stmt->fetch()) {
                    echo "<div class='game'>";
                    echo "<img src='" . htmlspecialchars($row['couverture_url_jeux']) . "' alt='" . htmlspecialchars($row['nom_jeux']) . "'>";
                    echo "<h3>" . htmlspecialchars($row['nom_jeux']) . "</h3>";
                    echo "<p>" . htmlspecialchars($row['editeur_jeux']) . "</p>";
                    echo "<button>AJOUTER À LA BIBLIOTHÈQUE</button>";
                    echo "</div>";
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
