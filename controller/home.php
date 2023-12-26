<?php

if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}
require_once 'model/database.php';
require_once 'model/user.php';
$userName = getUserName($_SESSION['userID']);

require_once './view/home.php';

