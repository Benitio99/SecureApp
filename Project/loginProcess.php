<?php
function checkUserExists($connection){
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
        $sql = "SELECT 1 FROM " . TABLE . " WHERE username = :username";
        $statement = $connection->prepare($sql);
        $data = [
            $username = $_GET['username'],
        ];

        $statement->bindValue(':username', $username);
        $result = $statement->execute();
        $id = $statement->fetchColumn();
        if ($id) {
            return true;
        }
    } catch(PDOException $e){
        die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
    }
    // Close statement
    unset($statement);
    // Close connection
    unset($connection);
}
function checkPasswordAgainstUser($connection) {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Now we check if the data was submitted, isset() function will check if the data exists.
    /*
    if (!isset($_POST['username']) && !isset($_POST['firstName']) && !isset($_POST['surname']) && !isset($_POST['email']) && !isset($_POST['passwordOne'])) {
        // Could not get the data that should have been sent.
        exit('Please complete the registration form!');
        echo "form not filled";
    }
    
    else if (empty($_POST['username']) || empty($_POST['firstName']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['password'])) {
        // One or more values are empty.
        exit('Please complete the registration form');
    }
    
    else {*/
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

if (isset($_GET["submit"])){
    //echo "<br><h3>attempting to input user<h3>";
    insertNewUser($databaseConnection);
}
else {
    //echo "<br><h3>Please enter your credentials below<h3>";
}
?>