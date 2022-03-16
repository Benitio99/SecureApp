<?php

include_once("server.php");
include_once("timeOutProcess.php");
include_once("inputUtils.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Main Page</title>
    <link href = "styles/project.css"rel = "stylesheet"></link>
    <script type = "text/javascript" src = "scripts/menuPop.js"></script>
  </head>
  <body>
    <nav>
      <button id="hamburger">
        <div class = "bar" id = "barOne"></div>
        <div class = "bar" id = "barTwo"></div>
        <div class = "bar" id = "barThree"></div>
      </button>
      <div id = "navWrapper">
        <ul class = "navLinks">
          <li><a href = "index.html" title = "home">Home</a></li>
          <li><a href = "login.php" title = "Login">Login</a></li>
          <li><a href = "register.php" title = "Register">Register</a></li>
          <?php 
            
            if ($_SESSION["loggedIn"] == true) {
                echo "
                	<li id = 'currentPage'><a href = 'main.php' title = 'Main'>Main</a></li>";
				if ($_SESSION["isAdmin"] == true) {
					echo "
						<li><a href = 'pageOne.html' title = 'pageOne'>PageOne</a></li>
						<li><a href = 'logs.html' title = 'pageTwo'>pageTwo</a></li>
					";
				}
				echo "
					<li><a href = 'resetPassword.php' title = 'ResertPassword'>Reset Password</a></li>
					<li><a href = 'logout.php' title = 'Logout'>Logout</a></li>
                ";
            }
            ?>
        </ul>
      </div>
    </nav>
    <main id = "mainArea">
    <h2>Main Page</h2>
    <?php
    if(isset($_SESSION["loggedIn"])) { 
      var_dump($_SESSION);
      echo '<h3>Login Success, Welcome - ' . customSanitise($_SESSION["loggedInUserFirstName"]) . " " . customSanitise($_SESSION["loggedInUserSurname"]) . '</h3>';
    }  
    else {  
      header("location: logout.php");  
    } 
    ?>
    </main>
  </body>
</html>