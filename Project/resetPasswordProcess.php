<?php

include_once("server.php");

function resetUserPassword($databaseConnection) {
    $sql = "";
    try{
        //echo "<br>Constructing Statement\n";
        // Prepare an insert statement

        $sql = "UPDATE " . TABLE . " SET password = AES_ENCRYPT(:password, '" . AESKEY . "') WHERE userId = " . $_SESSION['loggedInUser'] . ";";
        $statement = $databaseConnection->prepare($sql);
        
        $data = [
            $password = $_GET['passwordOne']
        ];

        $statement->bindValue(':password', $password);

        $statement->execute();
        $changed = $statement->fetchAll();
        
    } catch(PDOException $e){
        die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
    }
    if ($changed) {
        echo "<br><h1>Password Reset successfully.<h1>";
    }
    // Close statement
    unset($statement);
    
    // Close connection
    unset($databaseConnection);
}

function setCSRFToken() {
    $randomNumber = mt_rand(0, 9999999999);
    $_SESSION["storedCSRFToken"] = $randomNumber;
    echo $randomNumber;
}

//setCSRFToken();

if (isset($_GET["submit"])){
    //echo "<br><h3>attempting to input user<h3>";
    if (isset($_GET["CSRFToken"])) {
        if ($_GET["CSRFToken"] == $_SESSION["storedCSRFToken"]) {
            resetUserPassword($databaseConnection);
            header('Location: login.php', true, 303);
            echo "<br><p>You have successfully registered in the database.</p>";
        }
        else {
            echo "CSRFTokens do not match.";
        }
    }
    else {
        echo "No CSRFToken Set.";
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
}else {
    //echo "<br><h3>Please enter your credentials below<h3>";
}
?>