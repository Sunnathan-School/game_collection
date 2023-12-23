<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <title>Mise à jour du jeu</title>
    <link rel="stylesheet" href="assets\style\gameUpdate.css">
</head>
<body>
    <header>
        <!-- Insérez votre navigation et logo ici -->
    </header>

    <main class="game-update-container">
        <section class="game-info">

            <?php $gameDetails = getGame($pdo);?>

            <h1><?php echo $gameDetails['Nom_Jeu'] ?? ''; ?></h1>
            <p><?php echo $gameDetails['Desc_Jeu'] ?? ''; ?></p>
            <p>Temps passé : <?php echo $gameDetails['Heure_Jouees_Collection'] ?? '0' ?> heures</p>
            

            <form class="time-add-form" method="post">
                <h2>Ajouter du temps passé sur le jeu</h2>
                <label>Temps passé sur le jeu</label>
                <input type="number" id="time-spent" name="time_spent" placeholder="<?php echo $gameDetails['Heure_Jouees_Collection'] ?? '0'; ?>">
                <button type="submit" name="add_time">AJOUTER</button>
            </form>

            <form class="game-remove-form" method="post">
                <button type="submit" name="remove_game">SUPPRIMER LE JEU DE MA BIBLIOTHÈQUE</button>
            </form>
        </section>

        <section class="game-image">
            <img src="<?php echo $gameDetails['Couverture_Jeu'] ?? ''; ?>" alt="<?php echo $gameDetails['Nom_Jeu'] ?? ''; ?>">
        </section>
    </main>

    <footer>
        <!-- Insérez votre footer -->
    </footer>
</body>
</html>
