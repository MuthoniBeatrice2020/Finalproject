<?php

//error_reporting(0);

define('DB_USER','root');
define('DB_PASSWORD','');

try{
    //create connection
    $conn = new PDO("mysql:host=localhost", DB_USER, DB_PASSWORD);
    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // create db
    $s="CREATE DATABASE esp";
    //use exec() because no results are returned
    if ($conn->exec($s)){
        echo "DB created successfully";
        include 'create_table_admin.php'; 
    }

}catch (PDOException $e){
    echo "Connection Failed: ".$e->getMessage();
}

$conn = null;