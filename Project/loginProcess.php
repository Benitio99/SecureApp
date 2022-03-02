<?php

require ("server.php");

$_SESSION["loggedIn"] = False;
$_SESSION["admin"] = False;

function checkUserExists(){
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $sql = "SELECT 1 FROM " . TABLE . " WHERE username = :username";
        $statement = $databaseConnection->prepare($sql);
        $data = [
            $username = $_GET['username'],
        ];

        $statement->bindValue(':username', $username);
        $result = $statement->execute();
        $id = $statement->fetchColumn();
        if ($id) {
            return True;
        }
        else {
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
function checkUsersPassword(){
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $sql = "SELECT Admin? FROM " . TABLE . " WHERE username = :username";
        $statement = $databaseConnection->prepare($sql);
        $data = [
            $username = $unsanitisedUsername,
        ];

        $statement->bindValue(':username', $username);
        $result = $statement->execute();
        $admin = $statement->fetchColumn();
        if ($admin) {
            return True;
        }
        else {
            return False;
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
function checkUserIsAdmin(){
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $sql = "SELECT 1 FROM " . TABLE . " WHERE password = :password";
        $statement = $databaseConnection->prepare($sql);
        $data = [
            $password = $unsanitisedPassword,
        ];

        $statement->bindValue(':password', $password);
        $result = $statement->execute();
        $password = $statement->fetchColumn();
        if ($password) {
            return True;
        }
        else {
            return False;
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
function processLogin() {
        // Check if data is entered
    if (!isset($_GET['username']) && !isset($_GET['password'])) {
        exit('Please complete the registration form!');
        echo "form not filled";
    }
    else {
        //Form is filled in
        $unsanitisedUsername = $_GET['username'];
        echo "username: " . $unsanitisedUsername;
        $unsanitisedPassword = $_GET['password'];
        echo "password: " . $unsanitisedPassword;
        if (checkUserExists()){
            if (checkUsersPassword()) {
                $_SESSION["loggedIn"] = True;
                if (checkUserIsAdmin()) {
                    $_SESSION["admin"] = True;
                }
                else {
                    $_SESSION["admin"] = False;
                }
                Redirect('main.php');
            }
            else {

            }
        }
    }
}
if (isset($_GET["submit"])) {
    processLogin();
}
function checkPasswordAgainstUser($connection) {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
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