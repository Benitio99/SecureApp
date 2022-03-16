<?php

include_once("server.php");

function checkDuplicateEmail($databaseConnection, $email){
    try{
        $sql = "SELECT '*' FROM " . TABLE . " WHERE email = :email";
        $statement = $databaseConnection->prepare($sql);
        
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetchAll();
        if (!$result) {
            echo "<h3>email does not exist";
            return false;
        }
        else {
            return true;
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
function checkDuplicateUsername($databaseConnection, $username){
    try{
        $sql = "SELECT '*' FROM " . TABLE . " WHERE username = :username";
        $statement = $databaseConnection->prepare($sql);
        
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetchAll();
        if (!$result) {
            echo "<h3>user does not exist";
            return false;
        }
        else {
            return true;
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
function insertNewUser($databaseConnection) {
    $sql = "";
    try{
        do {
            $randomNumber = mt_rand(0, 9999999999);
            $randomCheckSql = "SELECT 1 FROM " . TABLE . " WHERE userId = $randomNumber";
            $statement = $databaseConnection->prepare($randomCheckSql);
            $statement->execute();
            $id = $statement->fetchAll();
            
            if(!$id) {
                break;
            }
        } while(true);
        //echo "<br>Constructing Statement\n";
        // Prepare an insert statement
        $sql = "INSERT INTO " . TABLE . "(userId, username, isAdmin, firstName, surname, email, password) VALUES(:userId, :username, :admin, :firstName, :surname, :email, AES_ENCRYPT(:password, '" . AESKEY . "'))";
        $statement = $databaseConnection->prepare($sql);
        
        $data = [
            $userId = $randomNumber,
            $username = $_GET['username'],
            $firstName = $_GET['firstName'],
            $surname = $_GET['surname'],
            $email = $_GET['email'],
            $password = $_GET['passwordOne']
        ];
        if (isset($_GET["isAdmin"])) {
            $data[$admin= $_GET["isAdmin"]];
        }
        else {
                $data[$admin = false];
        }
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':admin', $admin);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':surname', $surname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $inserted = $statement->fetchAll();
        
        
    } catch(PDOException $e){
        die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
    }
    if ($inserted) {
        //echo "<br><h1>Records inserted successfully.<h1>";
    }
    // Close statement
    unset($statement);
    
    // Close connection
    unset($databaseConnection);
}


if (isset($_GET["submit"])){
    //echo "<br><h3>attempting to input user<h3>";
    $noDuplicates = false;
    if (isset($_GET["username"])) {
        $username = $_GET["username"];
        if (checkDuplicateUsername($databaseConnection, $username)) {
            echo "<br><p>please choose another username or go to the login page.</p>";
        }
        else {
            if (isset($_GET["email"])) {
                $email = $_GET["email"];
                if (checkDuplicateEmail($databaseConnection, $email)) {
                    echo "<br><p>please choose another email or go to the login page.</p>";
                }
                else {
                    $noDuplicates = true;
                }
            }
        }
    }
    
    if ($noDuplicates) {
        insertNewUser($databaseConnection);
        header('Location: login.php', true, 303);
        echo "<br><p>You have successfully registered in the database.</p>";
    }
}

// Processing form data when form is submitted
/*
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $goodInputs = true;
    foreach ($inputs as $input){
        if (!isset($_GET[$input])){
            $goodInputs = false;
        }
    }
    if ($goodInputs) {
        include 'connection.php';

    // Validate inputs
    foreach ($inputs as $inputString) {
        $input = getInput(inputString);
        if (!checkNotEmptyInput($input)){
            getError($input);
        }
        elseif ($inputString == "firstname" || $inputString == "lastname" ) {
            if (!checkValidName($input)){
                getError($input);
            }
        }
        elseif ($inputString == "email"){

        }
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO access (firstname, surname, salary) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
function checkValidEmail($email, $error) {
    if(!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return false;
    }
    else {
        return true;
    }
}
function checkValidName($name, $error) {
    if(!filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return false;
    }
    else {
        return true;
    }
}
function checkNotEmptyInput($input){
    if(empty($input)){
        return false;
    }
    else{
        return true;
    }
}
function getInput($input){
    return trim($_GET[$input]);
}
function getError($input){
    if(empty($input)){
        return = "Please enter a ".$input.".";
    }
    elseif(!filter_var($input, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return = "Please enter a valid " . $input . ".";
    }
}
*/
#}
else {
    //echo "<br><h3>Please enter your credentials below<h3>";
}
?>