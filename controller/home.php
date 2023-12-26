<?php

if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}


require_once './view/home.php';

