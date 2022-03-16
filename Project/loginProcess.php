<?php

include_once("server.php");
include_once("inputUtils.php");

if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = False;
}
if (!isset($_SESSION["isAdmin"])) {
    $_SESSION["isAdmin"] = False;
}

function checkUserExists($databaseConnection, $username){
    //$databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $sql = "SELECT 1 FROM " . TABLE . " WHERE username = :username";
        $statement = $databaseConnection->prepare($sql);
        $data = [
            $username = $_GET['username'],
        ];

        $statement->bindValue(':username', $username);
        $statement->execute();
        $number = $statement->rowCount();
        if ($number == 1) {
            //echo "<br><p>User Exists!</p>";
            return True;
        }
        else {
            //echo "<br><p>User does not Exist!</p>";
            return False;
        }
    } catch(PDOException $e){
        die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
        return false;
    }
    // Close statement
    unset($statement);
    // Close connection
    unset($databaseConnection);
}
function checkUsersPassword($databaseConnection, $username, $password){
    //$databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{

        $sql = "SELECT userId, username, firstName, surname, AES_DECRYPT(password, '" . AESKEY . "') as decryptedPassword FROM " . TABLE . " WHERE username = :username AND AES_DECRYPT(password, '" . AESKEY . "') = '" . $password . "'";
        
        $statement = $databaseConnection->prepare($sql);

        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetchAll();
        if (!$result || count($result) > 1) {
            //echo "<p>1Username : '" . $username . "' and password: '" . $password . "' combination is incorrect</p>";
            return false;
        }
        else {
            if (verifyPassword($password, $result[0]["decryptedPassword"]) == 1) {
                $_SESSION["loggedInUserID"] = $result[0]["userId"];
                $_SESSION["loggedInUserUsername"] = $result[0]["username"];
                $_SESSION["loggedInUserFirstName"] = $result[0]["firstName"];
                $_SESSION["loggedInUserSurname"] = $result[0]["surname"];
                //var_dump($result);
                return true;
            }
            else {
                //echo "<h3>2Username submited: " . $username . " and password: " . $password . " combination is incorrect</h3>";
                return false;            
            }
        }
    } catch(PDOException $e){
        die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
        return False;
    }
    // Close statement
    unset($statement);
    // Close connection
    unset($databaseConnection);
}
function checkUserIsAdmin($databaseConnection, $adminUsername){
    try{
        $sql = "SELECT 'isAdmin' FROM " . TABLE . " WHERE username = :username";
        $statement = $databaseConnection->prepare($sql);
        
        $statement->bindValue(':username', $adminUsername);
        $statement->execute();
        $result = $statement->fetchAll();
        var_dump($result);
        //wait(10);
        if (!$result) {
            //echo "<h3>User does not exist</h3>";
            return false;
        }
        else {
            if ($result[0]["isAdmin"] == True) {
                return true;
            }
            else {
                return false;            
            }
        }
    } catch(PDOException $e){
        die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
        return false;
    }
    // Close statement
    unset($statement);
    // Close connection
    unset($databaseConnection);
}
function processLogin($databaseConnection) {
    // Check if data is entered
    if (!isset($_GET['username'], $_GET['password'])) {
        echo('Please complete the registration form!');
    }
    else {
        $unsanitisedUsername = $_GET['username'];
        $unsanitisedPassword = $_GET['password'];
        $sanitisedUsername = customSanitise($unsanitisedUsername);
        $sanitisedPassword = customSanitise($unsanitisedPassword);
        if (detectBadCharacters($unsanitisedUsername) || detectBadCharacters($unsanitisedPassword)) {
            echo "<br><p>Username: " . $sanitisedUsername . " and password: " . $sanitisedPassword . ", combination is incorrect.</p>";
        }
        elseif (checkUserExists($databaseConnection, $sanitisedUsername)){
            if (checkUsersPassword($databaseConnection, $sanitisedUsername, $sanitisedPassword)) {
                $_SESSION["loggedIn"] = true;
                //echo "logged in: " . $_SESSION["loggedIn"];
                if (checkUserIsAdmin($databaseConnection, $sanitisedUsername)) {
                    $_SESSION["isAdmin"] = true;
                }
                else {
                    $_SESSION["isAdmin"] = false;
                }
                //var_dump($_SESSION);
                $_SESSION['loginStartTime'] = time();

                header('Location: main.php', true, 303);
                exit;
            }
            else {
                echo "<br><p>Username: " . $sanitisedUsername . " and password: " . $sanitisedPassword . ", combination is incorrect.</p>";
            }
        }
    }
}
if (isset($_GET["submit"])) {  
    processLogin($databaseConnection);
}
?>