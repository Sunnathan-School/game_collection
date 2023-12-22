<?php

require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if(isset($_GET['page'])){
    switch($_GET['page']){
        # Home
        case 'home':
            require_once 'controller/home.php';
            break;
        # Games
        case 'addGame':
            require_once 'controller/gameAdd.php';
            break;
        case 'games':
            require_once 'controller/gameList.php';
            break;
        # Login
        case 'login':
            require_once 'controller/login.php';
            break;
        # Register
        case 'register':
            require_once 'controller/register.php';
            break;
        # User
        case 'user':
            require_once 'controller/userProfile.php';
            break;
        case 'editUser':
            require_once 'controller/userProfileEdit.php';
            break;
        # Ranking
        case 'ranking':
            require_once 'controller/ranking.php';
            break;
        # Default
        default:
            header('Location: home');
            break;
    }

}else{
    header('Location: home');
}