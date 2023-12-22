<?php
if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}
require_once 'model/collection.php';
require 'view/gameList.php';