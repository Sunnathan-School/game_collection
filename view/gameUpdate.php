<!-- view.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du jeu</title>
    <link rel="stylesheet" href="assets\style\gameUpdate.css">
</head>
<body>
    <header>
        <!-- Insérez votre navigation et logo ici -->
    </header>

    <main class="game-update-container">
        <section class="game-info">
            <h1>Read dead redemption 2</h1>
            <p>Jeu trop cool</p>
            <p>Temps passé : 60 h</p>

            <form class="time-add-form" action="updateGame.php" method="post">
                <label for="time-spent">Ajouter du temps passé sur le jeu</label>
                <input type="number" id="time-spent" name="time_spent" placeholder="60">
                <button type="submit" name="add_time">AJOUTER</button>
            </form>

            <form class="game-remove-form" action="removeGame.php" method="post">
                <button type="submit" name="remove_game">SUPPRIMER LE JEU DE MA BIBLIOTHÈQUE</button>
            </form>
        </section>

        <section class="game-image">
            <img src="path_to_image/red-dead-redemption-2.jpg" alt="Read dead redemption 2">
        </section>
    </main>

    <footer>
        Game Collection - 2023 - Tous droits réservés
    </footer>
</body>
</html>
