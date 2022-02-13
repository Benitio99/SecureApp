<?php
require("config.php");
$pdo;
function testConnection($connection){
    try {
        $pdo = new PDO($connection, ROOT);
        if ($pdo) {
            return true;
        }
    } catch (PDOException $error) {
        echo "Connection failed : ". $error->getMessage();
        return false;
    }
}

// Create connection Statement
#$databaseConnection = "mysql:host=".HOST.";dbname=".DATABASE.";charset=UTF8";

// Create connection Statement
#$baseConnection = "mysql:host=".HOST.";charset=UTF8";

$baseLink = mysqli_connect(HOST, ROOT);

 // Test the connection
 if ($baseLink){
    echo "<br>Connected to database system successfully";

    $createSADUser = "CREATE USER IF NOT EXISTS '" . SADUSERNAME . "'@'" . HOST . "' IDENTIFIED BY '" . SADPASSWORD  ."';";
    $result = mysqli_query($baseLink, $createSADUser);
   
    if ($result) {
        echo "<br>Created SAD user successfully\n";
        #$baseLink = mysqli_connect(HOST, SADUSERNAME, SADPASSWORD, DATABASE);

        $createDatabaseSQL = "CREATE DATABASE IF NOT EXISTS " . DATABASE . ";";
        $result = mysqli_query($baseLink, $createDatabaseSQL);
    
        if ($result) {
            echo "<br>Database Created Successfully\n";
            $createTableSQL = "
            USE access;
            CREATE TABLE IF NOT EXISTS '" . TABLE . "' (
                `userId` INT(10) UNSIGNED ZEROFILL AUTO_INCREMENT NOT NULL,
                `username` VARCHAR(20) NOT NULL,
                `admin?` BOOLEAN NOT NULL DEFAULT FALSE,
                `firstName` VARCHAR(20) NOT NULL,
                `surname` VARCHAR(20) NOT NULL,
                `email` VARCHAR(30) NOT NULL,
                `password` VARCHAR(30) NOT NULL,
                PRIMARY KEY ('userId'),
                UNIQUE (`email`)
            )
            COMMENT = 'A table of all users';
            ";
            $result = mysqli_multi_query($baseLink, $createTableSQL);
            if ($result){
                echo "<br>Table Created Successfully\n";
            }
            else {
                echo "<br>Table could not be created!\n";
            }
        }
        else {
                echo "<br>Database could not be created!\n";
        }
    }
    else {
        echo "<br>SADUser could not be created!\n";
    }
 }
 else {
    echo "<br>Could Not connect\n";
    die("Error, could not connect: ".mysqli_connect_error());
 }
 echo "\n";

?>