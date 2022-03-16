<?php
  require_once 'header.php';
  echo date('h:i:s:ns') . "<br>";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Logout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Pierce Bennett">
    <meta name="copyright" content="© 2018 Pierce Bennett">
    <meta name="language" content="EN">
    <link href="styles/project.css"rel="stylesheet"></link>
    <script type="text/javascript" src="scripts/menuPop.js"></script>
  </head>
  <body>
    <nav>
      <button id="hamburger">
        <div class="bar" id="barOne"></div>
        <div class="bar" id="barTwo"></div>
        <div class="bar" id="barThree"></div>
      </button>
      <div id="navWrapper">
        <ul class="navLinks">
          <li id="currentPage"><a href="index.php" title="Home">Home</a></li>
          <li><a href="login.php" title="Login">Login</a></li>
          <li><a href="register.php" title="Register">Register</a></li>
          <li id = "currentPage"><a href="logout.php" title="Logout">Logout</a></li>
        </ul>
      </div>
    </nav>
    <main id = "mainArea">
      <div>
        <h3>You have been logged off.</h3>
        <div class="buttons">
          <input type = "button" value = "home" name = "home"><a href="index.php" title="Home">HomePage</a></input>
        </div> 
      </div>
    </main>
  </body>
</html>
<?php
  include("logoutProcess.php");
?>
    