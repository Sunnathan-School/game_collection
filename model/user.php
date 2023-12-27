<?php

/**
 * Ajoute un utilisateur
 *
 * @param  string $userSurname Prénom de l'utilisateur
 * @param  string $userName Nom de l'utilisateur
 * @param  string $userMail Mail du client
 * @param  string $userPassword Mot de passe du client
 * @return void
 */
function addUser($userSurname, $userName, $userMail, $userPassword){
    global $bdd;



    $sql = "INSERT INTO utilisateurs (Pren_Utilisateur, Nom_Utilisateur, Email_Utilisateur, Mdp_Utilisateur) VALUES (:prenUser, :nomUser, :mailUser, :pwdUser)";

    $stmt = $bdd->prepare($sql);
    $stmt->execute([':prenUser' => $userSurname,
                    ':nomUser' => $userName,
                    ':mailUser' => $userMail,
                    ':pwdUser' => password_hash($userPassword, PASSWORD_DEFAULT),
        ]);
}

/**
 * Vérifie les informations de connexion et connecte l'utilisateur
 * @param $userMail
 * @param $userPassword
 * @return boolean
 */
function connectUser($userMail, $userPassword)
{
    global $bdd;
    $sql = "SELECT Id_Utilisateur,Email_Utilisateur,Mdp_Utilisateur FROM UTILISATEURS WHERE Email_Utilisateur = :userMail";

    $stmt = $bdd->prepare($sql);
    $stmt->execute(['userMail' => $userMail]);
    $user = $stmt->fetch();

    if($user){
        $pwdVerif = password_verify($userPassword,$user['Mdp_Utilisateur']);
        if ($pwdVerif){
            // connection effectuer
            $_SESSION['userID'] = $user['Id_Utilisateur'];
            return true;
        }
    }
    return false;
}

/**
 * Récupère le nom de l'utilisateur
 * @param int $userId identifiant de l'utilisateur
 * @return string nom de l'utilisateur
 */
function getUserName($userId){
    global $bdd;
    $sql = "SELECT Pren_Utilisateur FROM UTILISATEURS WHERE Id_Utilisateur = :userId";

    $stmt = $bdd->prepare($sql);
    $stmt->execute(['userId' => $userId]);
    $user = $stmt->fetch();

    if ($user){
        return strtoupper($user['Pren_Utilisateur']);
    }
    return null;
}


function getUserGames($userId){
    global $bdd;
    $sql = "SELECT jeux.Id_Jeu,jeux.Nom_Jeu,jeux.Couverture_Jeu, GROUP_CONCAT(plateforme.Nom_Plateforme) AS Plateformes, HOUR(collections.Heure_Jouees_Collection) AS Heure_jouees FROM collections 
INNER JOIN jeux ON collections.Id_Jeu=jeux.Id_Jeu
LEFT JOIN disponible ON jeux.Id_Jeu=disponible.Id_Jeu
LEFT JOIN plateforme ON disponible.Id_plateforme=plateforme.Id_plateforme
WHERE collections.Id_Utilisateur=:userId";

    $stmt = $bdd->prepare($sql);
    $stmt->execute(['userId'=>$userId]);
    return $stmt->fetchAll();
}