<?php
if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}
require_once 'model\ranking.php';
require_once 'model/database.php';
require 'view\ranking.php';