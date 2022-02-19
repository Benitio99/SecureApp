<?php

require("server.php");
session_start();

#if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_email'])) {
    
#CREATE USER 'SADUSER'@'localhost' IDENTIFIED BY 'SADUSER';
/*
function prepareInsertStatement($connection, $statement, array $arguments) {
    $statement = "INSERT INTO access";
    $statement += " (";
    $arrayLength = count($arguments);
    foreach ($arguments as $key => $value) {
        $arrayLength--;
        $statement += "$key";
        if ($arrayLength >= 1) {
            $statement += $key . ", ";
        }
    }
    $statement += ") VALUES (";
    $arrayLength = count($arguments);
    foreach ($arguments as $item) {
        $arrayLength--;
        $statement += "?";
        if ($arrayLength >= 1) {
            $statement += $key . ", ";
        }
    }
    $statement += ")";
    $preparedStatement = $connection->prepare("statement");
    return $preparedStatement;
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);


// set parameters and execute
$arguments = array(
    "firstname" => "John",
    "lastname" => "Doe",
    "email" => "john@example.com"
);

$firstname = 
$stmt->execute();
*/

?>