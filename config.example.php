<?php

/*database credentials*/
define('DB_SERVER', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');
define('DB_PORT', '');
/*attempt to connect to db*/
try{
    $pdo = new PDO("mysql:host=".DB_SERVER.";port=".DB_PORT.";dbname=".DB_NAME, 
    DB_USER, DB_PASS);
    //set the pdo error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOEXCEPTION $e){
    die("Error:Could not connect". $e->getMessage());
}