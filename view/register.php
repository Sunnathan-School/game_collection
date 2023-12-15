<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/login.css">
    <title>Document</title>
</head>

<body>

    <div class="login">
        <h1>Se connecter à Game Collection</h1>
        <form action="" method="POST">

            <label for="nom">Nom :</label>
            <input type="text" name="nom">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom">
            <label for="email">Email :</label>
            <input type="text" name="email">
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp">
            <label for="confMdp">Confirmation du mot de passe :</label>
            <input type="password" name="confMdp">

            <input id="connect" type="submit" value="S'IDENTIFIER" />
        </form>
        <a href="register">Se connecter</a>
    </div>


</body>

</html>