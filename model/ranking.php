<?php

/**
 * Récupère le classement des joueurs
 *
 * @return void
 */
function getRanking() {

    $sql = "SELECT u.Pren_Utilisateur,u.Nom_Utilisateur,MAX(j.Nom_Jeu) AS Jeu_Le_Plus_Joué,
    SUM(TIME_TO_SEC(c.Heure_Jouees_Collection)) AS Temps_Total_Passé
    FROM UTILISATEURS u JOIN COLLECTIONS c ON u.Id_Utilisateur = c.Id_Utilisateur
    JOIN JEUX j ON c.Id_Jeu = j.Id_Jeu GROUP BY 
    u.Id_Utilisateur
    ORDER BY Temps_Total_Passé DESC;";

   
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
      
}

$players = getRanking($bdd);

?>