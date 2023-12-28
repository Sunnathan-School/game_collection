<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-Content-Type-Options" content="nosniff">
<title>Game Collection</title>
<link href="assets/style/gameList.css" rel="stylesheet" />
</head>
<body>
<?php require_once 'view/components/header.php'; ?>

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
        <h2>Jeux disponibles</h2>
        <div class="game-container">
        
        <?php            
        foreach ($games as $game) {
            ?>
            <form method='post' class='game-form'>
                <input type='hidden' name='game_id' value='<?php echo $game['Id_Jeu']; ?>'>
                <div class='game' style='background-image: url("<?php echo htmlspecialchars($game['Couverture_Jeu']); ?>");'>
                    <div class='game-overlay'></div>
                    <h3><?php echo $game['Nom_Jeu']; ?></h3>
                    <p><?php echo $game['Editeur_Jeu']; ?></p>
                    <button type='submit' name='add_collection'>AJOUTER À LA BIBLIOTHÈQUE</button>
                </div>
            </form>
            <?php
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
