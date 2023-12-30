<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/style/userProfile.css">
    <title>Profil</title>
</head>
<body>
    <?php require_once 'view/components/header.php'; ?>
    <main>
        <h1>Mon profil</h1>

        <form action="profil" method="post" autocomplete="off">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" autocomplete="false" value="<?php echo $userInfo['Nom_Utilisateur']?>">

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" autocomplete="false" value="<?php echo $userInfo['Pren_Utilisateur']?>">

            <label for="mail">Email :</label>
            <input type="email" name="mail" id="mail" autocomplete="false" value="<?php echo $userInfo['Email_Utilisateur']?>">

            <label for="password">Nouveau mot de passe :</label>
            <input type="password" name="password" id="password" autocomplete="false">

            <label for="password_conf">Confirmation du nouveau mot de passe :</label>
            <input type="password" name="password_conf" id="password_conf" autocomplete="false">

            <button type="submit" name="edit" value="1">Modifier</button>
            <button type="submit" name="remove" value="1">Supprimer mon compte</button>
            <button type="submit" name="disconnect" value="1">Se déconnecter</button>

        </form>
    </main>
    <?php require_once 'view/components/footer.php'; ?>

</body>
</html>