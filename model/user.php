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
 * Supprime l'utilisateur
 *
 * @param  int $userId Identifiant de l'utilisateur
 * @return void
 */
function removeUser($userId){}

/**
 * Mise a jour de l'utilisateur
 *
 * @param  int $userId Identifiant de l'utilisateur
 * @param  string $userSurname Prénom de l'utilisateur
 * @param  string $userName Nom de l'utilisateur
 * @param  string $userMail Mail du client
 * @param  string $userPassword Mot de passe du client
 * @return void
 */
function editUser($userId, $userSurname, $userName, $userMail, $userPassword){}

/**
 * Récupère l'ensemble des utilisateurs
 *
 * @return array
 */
function getUsers(){}