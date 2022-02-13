<?php

include ("connection.php");

function insertNewUser($connection, array $arguments) {
    $placeholders = array_fill(0, count($arguments), '?');
    /*
    $keys = $values = array();
    foreach($array as $key => $value) {
        $keys[] = $key;
        $values[] = $value;
    }
    */
    $query = "INSERT INTO '".TABLE."' ".
             "(".implode(',', array_keys($arguments)).") VALUES ".
             "(".implode(',', $placeholders).")";

             
    $statement = $connection->prepare($query);

    $statement->execute(array_values($arguments));
/*
    $statement->prepare($query);

    call_user_func_array(
        array($statement, 'bind_param'), 
        array_merge(array(str_repeat('s', count($values))), $values)
    );

    $statement->execute();

    $preparedStatement = $connection->prepare($statement);
    return $preparedStatement;
*/}

$registrationDetails = array(
    "firstName" => "John",
    "surname" => "Doe",
    "email" => "john@example.com"
);
#insertNewUser($baseConnection, $registrationDetails);
/*
// Define variables and initialize with empty values
$firstname = $surname = $email = "";
$firstNameError = $surnameError = $emailError = "";
$inputs = array(
    "firstName",
    "surname",
    "email"
);
*/
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
    // Validate salary
    $input_salary = trim($_GET["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
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
?>