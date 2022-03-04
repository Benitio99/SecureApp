<?php

require ("server.php");
require ("inputUtils.php");

$_SESSION["loggedIn"] = False;
$_SESSION["admin"] = False;

function checkUserExists($databaseConnection, $username){
    //$databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $sql = "SELECT 1 FROM " . TABLE . " WHERE username = :username";
        $statement = $databaseConnection->prepare($sql);
        $data = [
            $username = $_GET['username'],
        ];

        $statement->bindValue(':username', $username);
        $result = $statement->query();
        $id = $statement->fetchAll();
        if ($id) {
            echo "<br><p>User Exists!</p>";
            return True;
        }
        else {
            echo "<br><p>User does not Exist!</p>";
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
        
        //echo "\n:: " . $sql . "\n";
        
        $statement = $databaseConnection->prepare($sql);
        /*$data = [
            $username = $unsanitisedUsername,
        ];
*/
        $statement->bindValue(':username', $username);
        $statement->query();
        $result = $statement->fetchAll();
        echo '<pre>'; print_r($result); echo '</pre>';
        if (!$result) {
            echo "<p>1Username : '" . $username . "' and password: '" . $password . "' combination is incorrect</p>";
            return false;
        }
        else {
            echo "<br><h1>" . verifyPassword($password, $result["decryptedPassword"]);
            if (verifyPassword($password, $result["decryptedPassword"]) == 1) {
                $_SESSION["loggedInUserID"] = $result["userId"];
                $_SESSION["loggedInUserUsername"] = $result["username"];
                $_SESSION["loggedInUserFirstName"] = $result["firstName"];
                $_SESSION["loggedInUserSurname"] = $result["surname"];
            }
            else {
                echo "<h3>2Username submited: " . $username . " and password: " . $password . " combination is incorrect</h3>";
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
        $data = [
            $username = $adminUsername,
        ];

        $statement->bindValue(':username', $username);
        $statement->query();
        $result = $statement->fetchAll();
        if (!$result) {
            echo "<h3>User does not exist";
            return false;
        }
        else {
            if ($result["isAdmin"] == 1) {
                return true;
            }
            else {
                echo "<h3>User is not an administrator";
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
function processLogin($databaseConnection) {
        // Check if data is entered
    if (!isset($_GET['username'], $_GET['password'])) {
        exit('Please complete the registration form!');
        echo "<p>form not filled</p>";
    }
    else {
        //Form is filled in
        $unsanitisedUsername = $_GET['username'];
        echo "<brUusername: " . $unsanitisedUsername;
        $unsanitisedPassword = $_GET['password'];
        echo "\tPassword: " . $unsanitisedPassword;
        if (checkUserExists($databaseConnection, $unsanitisedUsername)){
            if (checkUsersPassword($databaseConnection, $unsanitisedUsername, $unsanitisedPassword)) {
                $_SESSION["loggedIn"] = True;
                if (checkUserIsAdmin($databaseConnection, )) {
                    $_SESSION["admin"] = True;
                }
                else {
                    $_SESSION["admin"] = False;
                }
                echo "<p> redirecting to main page...</p>";
                header('Location: main.php', True, 301);
            }
            else {
            }
        }
    }
}
if (isset($_GET["submit"])) {
    processLogin($databaseConnection);
}
function checkPasswordAgainstUser($databaseConnection) {
    $$databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        //echo "form filled";
        /* Attempt MySQL server connection. Assuming you are running MySQL
        server with default setting (user 'root' with no password) */
        /*try{
            echo "creating pdo";
            $pdo = new PDO('mysql:host = "' . HOST . '";dbname = "' . DATABASE . ';', SADUSER, SADPASSWORD);
            // Set the PDO error mode to exception
        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
        */
        // Attempt insert query execution
        try{
            do {
                $randomNumber = mt_rand(0, 9999999999);
                $randomCheckSql = "SELECT 1 FROM " . TABLE . " WHERE userId = $randomNumber";
                $statement = $connection->prepare($randomCheckSql);
                $statement->execute();
                $id = $statement->fetchColumn();
                //$query_object = mysqli_query($db_connection, "SELECT 1 FROM " . TABLE . " WHERE userId = $random_number");
                //$query_record = mysqli_fetch_array($query_object);
                //if(! $query_record) {
                  //  break;
                //}
                if(!$id) {
                    break;
                }
            } while(true);
            //echo "<br>Constructing Statement\n";
            // Prepare an insert statement
            $sql = "INSERT INTO " . TABLE . "(userId, username, admin, firstName, surname, email, password) VALUES(:userId, :username, :admin, :firstName, :surname, :email, AES_ENCRYPT(:password, '" . AESKEY . "'))";
            $statement = $connection->prepare($sql);
            $data = [
                $userId = $randomNumber,
                $username = $_GET['username'],
                $admin = false,
                $firstName = $_GET['firstName'],
                $surname = $_GET['surname'],
                $email = $_GET['email'],
                $password = $_GET['passwordOne']
            ];

            
            
            //$statement -> bindValue(":username", $username);
            // Bind parameters to statement
            
            $statement->bindValue(':userId', $userId);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':admin', $admin);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':surname', $surname);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            
            /* Set the parameters values and execute
            the statement again to insert another row */
            /*$username = "";
            $firstName = "John";
            $surname = "Smith";
            $email = "jsmith@email.com";
            $password = "";
            */
            $inserted = $statement->execute();
            
        } catch(PDOException $e){
            die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
        }
        if ($inserted) {
            //echo "<br><h1>Records inserted successfully.<h1>";
        }
        
        // Close statement
        unset($statement);
        
        // Close connection
        unset($connection);
    }
#}

?>