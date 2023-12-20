<!-- view.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:;">
    <title>Mise à jour du jeu</title>
    <link rel="stylesheet" href="assets\style\gameUpdate.css">
</head>
<body>
    <header>
        <!-- Insérez votre navigation et logo ici -->
    </header>

    <main class="game-update-container">
        <section class="game-info">

            <?php $gameDetails = getGames();?>

            <h1><?php echo htmlspecialchars($gameDetails['nom_jeux']?? null); ?></h1>
            <p><?php echo htmlspecialchars($gameDetails['description_jeux'] ?? null); ?></p>
            <p>Temps passé : <?php echo htmlspecialchars($gameDetails['heures_jouees_collection'] ?? 0); ?> </p>
            

            <form class="time-add-form" method="post">
                <label for="time-spent">Ajouter du temps passé sur le jeu</label>
                <input type="number" id="time-spent" name="time_spent" placeholder=<?php echo htmlspecialchars($gameDetails['heures_jouees_collection'] ?? 0); ?>>
                <button type="submit" name="add_time">AJOUTER</button>
            </form>

            <form class="game-remove-form" method="post">
                <button type="submit" name="remove_game">SUPPRIMER LE JEU DE MA BIBLIOTHÈQUE</button>
            </form>
        </section>

        <section class="game-image">
            <img src="<?php echo htmlspecialchars($gameDetails['couverture_url_jeux']); ?>" alt="<?php echo htmlspecialchars($gameDetails['nom_jeux'] ?? null); ?>">
        </section>
    </main>

    <footer>
        <!-- Insérez votre footer -->
    </footer>
</body>
</html>
