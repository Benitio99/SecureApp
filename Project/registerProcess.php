<?php

require ("server.php");

function insertNewUser() {
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
            do {
                $randomNumber = mt_rand(0, 9999999999);
                $randomCheckSql = "SELECT 1 FROM " . TABLE . " WHERE userId = $randomNumber";
                $statement = $databaseConnection->prepare($randomCheckSql);
                $statement->execute();
                $id = $statement->fetchColumn();
                
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

            $statement->bindValue(':userId', $userId);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':admin', $admin);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':surname', $surname);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            
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
        unset($databaseConnection);
    }


if (isset($_GET["submit"])){
    //echo "<br><h3>attempting to input user<h3>";
    insertNewUser();


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
}
else {
    //echo "<br><h3>Please enter your credentials below<h3>";
}
?>