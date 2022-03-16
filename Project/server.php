<?php
require("connection.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["sessionStartTime"])) {
    $_SESSION["sessionStartTime"] = microtime(true); 
}

/*
if (isset($_SESSION["loggedIn"])) {
    if ($_SESSION["loggedIn"]== False) {
        Redirect('Location: index.php', True, 301);
    }
}*

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