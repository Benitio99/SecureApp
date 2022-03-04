<?php
require("connection.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
if (isset($_SESSION["loggedIn"])) {
    if ($_SESSION["loggedIn"]== False) {
        Redirect('Location: index.php', True, 301);
    }
}*/
 // Test the connection
 /*
 if (testConnection($databaseConnection)){
    echo "<br>Connected to ".DATABASE." database successfully";
 }
 else {
     echo "<br>Could not connect to ".DATABASE." database.";
 }
 */
 //echo "\n";

 //place this before any script you want to calculate time
$timeStart = microtime(true); 

//sample script
#for($index = 0; $index < 1000; $index++){
 //do anything
#}
/*
$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart);
while (executionTime < 10) {
    echo '<b>Total Execution Time:</b> '.($executionTime*1000).'Milliseconds';

}*/
?>