<?php
require("config.php");

// Create connection Statement
$baseConnection = new PDO("mysql:host=" . HOST , ROOT, "");
$databaseConnection;
$testDB = "";

function testConnection($connection){
    try {
        if ($connection) {
            return true;
        }
    } catch (PDOException $error) {
        echo "Connection failed : ". $error->getMessage();
        return false;
    }
}

 // Test the connection
function databaseSetup($baseConnection) {
    if (testConnection($baseConnection)){
        echo "<br>Connected to database system successfully";
        $createSADUsersql = "CREATE USER IF NOT EXISTS '" . SADUSERNAME . "'@'" . HOST . "' IDENTIFIED BY '" . SADPASSWORD  ."';";
        try{
            $baseConnection->exec($createSADUsersql);
            $grantPrivileges = "GRANT ALL ON " . DATABASE . ".* TO '" . SADUSERNAME . "'@'" . HOST . "';";
            echo "<br>Created SADUSER successfully\n";
            $baseConnection->exec($grantPrivileges);
            echo "<br>Granted privileges to  SADUSER successfully\n";
            $flush = "FLUSH PRIVILEGES;";
            $baseConnection->exec($flush);
            echo "<br>Flushed privileges\n";
            $createDatabaseSQL = "CREATE DATABASE IF NOT EXISTS " . DATABASE . ";";
            try{
                $baseConnection->exec($createDatabaseSQL);
                echo "<br>Database Created Successfully\n";
                $sql = "USE " . DATABASE . ";";
                $baseConnection->exec($sql);
                $createTableSQL = "CREATE TABLE IF NOT EXISTS " . TABLE . " (
                                        userId INT(10) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY,
                                        username VARCHAR(20) NOT NULL UNIQUE,
                                        isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
                                        firstName VARCHAR(20) NOT NULL,
                                        surname VARCHAR(20) NOT NULL,
                                        email VARCHAR(30) NOT NULL UNIQUE,
                                        password BLOB NOT NULL
                                    )
                                    COMMENT = 'A table of all users';";
                
                try{
                    $baseConnection->exec($createTableSQL);
                    echo "<br>Table Created Successfully\n";
                    try {
                        $insertAdminSql = "INSERT INTO " . TABLE . "(userId, username, isAdmin, firstName, surname, email, password) VALUES(1, 'ADMIN', TRUE, '', '', '', AES_ENCRYPT('SaD_2021!', '" . AESKEY . "'))";
                        $statement = $baseConnection->prepare($insertAdminSql);
                        $baseConnection->exec($insertAdminSql);
                        echo "<br>Admin User inserted Successfully\n";
                    }
                    catch (PDOException $e){
                        echo "<br>ERROR: Could not execute " . $insertAdminSql . ": " . $e->getMessage();
                        unset($baseConnection);
                    }
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

}
try {
    $databaseConnection = new PDO("mysql:host=".HOST.";dbname=".DATABASE.";charset=UTF8", SADUSERNAME, SADPASSWORD);
    $databaseConnection->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $testDB = "SELECT * FROM " . DATABASE . "." . TABLE;
    $statement = $databaseConnection->prepare($testDB);
    $databaseConnection->exec($testDB);
    echo "<br>Database already set up.\n";
}
catch (PDOException $e){
    echo "<br>ERROR: Could not execute " . $testDB . ": " . $e->getMessage();
    databaseSetup($baseConnection);
}
?>