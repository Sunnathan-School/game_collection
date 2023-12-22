<?php
if (!isset($_SESSION['userID'])){
    header("Location: login");
    exit();
}
echo 'userProfile';