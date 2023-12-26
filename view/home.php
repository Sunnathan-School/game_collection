<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/home.css">
    <title>Accueil</title>
</head>
<body>

    <?php require_once 'view/components/header.php'; ?>

    <div class="bandeauAccueil">
        <div class="textBandeau">
            <h2>SALUT <?php echo $userName ?> !</h2>
            <h2>PRÊT À AJOUTER DES</h2>
            <h2>JEUX À TA COLLECTION ?</h2>
        </div>
    </div>

    <section id="game-library">
        <h2>Mes jeux</h2>
        <div class="list">
            <!-- ajouter le for each -->
            <div class='game' style='background-image: url("assets/img/exempleJeu.jpg");'>
                <div class='game-overlay'>
                    <div class="text">
                        <h3>Red Dead Redemption</h3>
                        <p>Playstation</p>
                    </div>
                    <p id="temps">8H</p>
                </div>
            </div>

            <div class='game' style='background-image: url("assets/img/exempleJeu.jpg");'>
                <div class='game-overlay'>
                    <div class="text">
                        <h3>Un jeu d'avaneture connu avec un nom plutôt long</h3>
                        <p>Playstation</p>
                    </div>
                    <p id="temps">8H</p>
                </div>
            </div>

            <div class='game' style='background-image: url("assets/img/exempleJeu.jpg");'>
                <div class='game-overlay'>
                    <div class="text">
                        <h3>Red Dead Redemption</h3>
                        <p>Playstation</p>
                    </div>
                    <p id="temps">8H</p>
                </div>
            </div>

            <div class='game' style='background-image: url("assets/img/exempleJeu.jpg");'>
                <div class='game-overlay'>
                    <div class="text">
                        <h3>Red Dead Redemption</h3>
                        <p>Playstation</p>
                    </div>
                    <p id="temps">8H</p>
                </div>
            </div>

            <div class='game' style='background-image: url("assets/img/exempleJeu.jpg");'>
                <div class='game-overlay'>
                    <div class="text">
                        <h3>Red Dead Redemption</h3>
                        <p>Playstation</p>
                    </div>
                    <p id="temps">8H</p>
                </div>
            </div>

            <div class='game' style='background-image: url("assets/img/exempleJeu.jpg");'>
                <div class='game-overlay'>
                    <div class="text">
                        <h3>Red Dead Redemption</h3>
                        <p>Playstation</p>
                    </div>
                    <p id="temps">8H</p>
                </div>
            </div>
        </div>
    </section>


    <footer></footer>

</body>
</html>