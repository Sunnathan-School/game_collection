<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/register.css">
    <title>Inscription</title>
</head>

<body>

    <div class="login">
        <h1>Inscription</h1>
        <form action="" method="POST">

            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" required>
            <label for="confMdp">Confirmation du mot de passe :</label>
            <input type="password" name="confMdp" id="confMdp" required>

            <input id="connect" type="submit" value="S'INSCRIRE" />
        </form>
        <a href="login">Se connecter</a>
    </div>


</body>

</html>