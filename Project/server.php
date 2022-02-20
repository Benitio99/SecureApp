<?php
require("config.php");
function testConnection($connection){
    try {
        $pdo = new PDO($connection, ROOT);
        if ($pdo) {
            return true;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

// Create Database Statement
$createdb = "CREATE DATABASE IF NOT EXISTS ".DATABASE;

// Create connection Statement
$databaseConnection = "mysql:host=".HOST.";dbname=".DATABASE.";charset=UTF8";

// Create connection Statement
$baseConnection = "mysql:host=".HOST.";charset=UTF8";

 // Test the connection
 if (testConnection($baseConnection)){
    echo "Connected to ".DATABASE." database successfully";
 }
 else {
     echo "Could not connect to ".DATABASE." database.";
 }
 echo "/n";
?>