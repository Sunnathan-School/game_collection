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
function addUser($userSurname, $userName, $userMail, $userPassword){}


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