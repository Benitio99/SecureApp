<?php
require("inputUtils.php");
// 1 hour max session time, 10 mins max inactivity time 
$_SESSION["maxTime"] = 240;
if(isset($_SESSION["loginStartTime"])) {  
    if((time() - $_SESSION['loginStartTime']) > $_SESSION["maxTime"]) {  
        //header("location: logout.php");  
    }  
    else {  
        $_SESSION['lastActivity'] = time();  
        echo "<p>Hello ".customSanitise($_SESSION["loggedInUserFirstName"])."</h1>";  
        echo "<p>You logged in @: ".$_SESSION["loginStartTime"]."</h1>";
    }  
}  
else { 
    //header('location: login.php', true, 301);  
}  
?>  