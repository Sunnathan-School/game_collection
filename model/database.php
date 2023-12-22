<?php

$bdd = createDBConnection($_ENV['DB_HOST'], $_ENV['DB_NAME'],$_ENV['DB_USER'],$_ENV['DB_PASSWORD']);

function createDBConnection($host, $dbName, $userName, $pwd){
    return new PDO("mysql:host=" . $host . ";dbname=" . $dbName, $userName, $pwd);
}

