<?php
require("config.php");

$baseConnection = new PDO("mysql:host=" . HOST , ROOT, "");

//$SADUserConnection = new PDO("mysql:host=" . HOST , SADUSER, SADPASSWORD);
//$pdo = new PDO("mysql:host=localhost", "root", "");
function testConnection($connection){
    try {
        //$databaseConnection = new PDO("mysql:host = " . HOST . ";dbname = " . DATABASE . ";username = " . SADUSER . "; password = " . SADPASSWORD . "; charset=UTF8");
        //$pdo = new PDO("mysql:host = ;dbname=demo", "root", ""$connection, ROOT);
        if ($connection) {
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

//$baseLink = mysqli_connect(HOST, ROOT);

 // Test the connection
    if (testConnection($baseConnection)){
        echo "<br>Connected to database system successfully";
        $createSADUsersql = "CREATE USER IF NOT EXISTS '" . SADUSERNAME . "'@'" . HOST . "' IDENTIFIED BY '" . SADPASSWORD  ."';";
        try{
            $baseConnection->exec($createSADUsersql);
            echo "<br>Created SAD user successfully\n";
            $createDatabaseSQL = "CREATE DATABASE IF NOT EXISTS " . DATABASE . ";";
            try{
                $baseConnection->exec($createDatabaseSQL);
                echo "<br>Database Created Successfully\n";
                $sql = "USE " . DATABASE . ";";
                $baseConnection->exec($sql);
                $createTableSQL = "CREATE TABLE IF NOT EXISTS " . TABLE . " (
                                        userId INT(10) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY,
                                        username VARCHAR(20) NOT NULL UNIQUE,
                                        admin BOOLEAN NOT NULL DEFAULT FALSE,
                                        firstName VARCHAR(20) NOT NULL,
                                        surname VARCHAR(20) NOT NULL,
                                        email VARCHAR(30) NOT NULL UNIQUE,
                                        password BLOB NOT NULL
                                    )
                                    COMMENT = 'A table of all users';";
                try{
                    $baseConnection->exec($createTableSQL);
                    echo "<br>Table Created Successfully\n";
                }
                catch (PDOException $e){
                    echo "<br>ERROR: Could not execute " . $createTableSQL . ": " . $e->getMessage();
                    unset($baseConnection);
                }
            }
            catch (PDOException $e){
                echo "<br>ERROR: Could not execute " . $createDatabaseSQL . ": " . $e->getMessage();
                unset($baseConnection);

            }
        }
        catch (PDOException $e){
            echo "<br>ERROR: Could not execute " . $createSADUsersql . ": " . $e->getMessage();
            unset($baseConnection);
        }
    }
    else {
        echo "<br>Could not connect to the system\n";
        unset($baseConnection);
    }
?>