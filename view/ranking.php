<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="charset=utf-8">
    <title>Classement des temps passés</title>
    <link rel="stylesheet" href="assets/style/ranking.css">
</head>
<body>
    <?php require_once 'view/components/header.php'; ?>
    <div class="ranking-container">
        <h1>Classement des temps passés</h1>
        <table>
            <tr>
                <th>Joueur</th>
                <th>Temps passés</th>
                <th>Jeu favori</th>
            </tr>
            <?php foreach ($players as $player): ?>
            <tr>
            <td><?php echo $player['Pren_Utilisateur'] . " " . $player['Nom_Utilisateur']; ?></td>
                <td><?php echo $player['Temps_Total_Passé']; ?></td>
                <td><?php echo $player['Jeu_Le_Plus_Joué']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <footer>
        <!-- Ajouter footer à la place -->
        
    </footer>
</body>
</html>
