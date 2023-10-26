<?php
session_start();
include "constants.php";
include BASE_PATH . "bootstrap/config.php";
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "libs/helpers.php";
try{
    $pdo = new  PDO("mysql:dbname=$database_config->db;host={$database_config->host}",
    $database_config->user,$database_config->pass);
}
catch(PDOException $e){
    diepage('connection failed:'. $e->getMessage());
}
// // echo "connection to database is ok";

include BASE_PATH . "libs/lib-auth.php";
include BASE_PATH . "libs/lib-tasks.php";






