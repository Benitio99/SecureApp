<?php
  require_once 'header.php';
  include("loginProcess.php");

  echo date('h:i:s:ns') . "<br>";

  if (isset($_POST["Password"])) {
    $unsanitisedPassword = $_POST["Password"];
    sanatisePassword();
    if(PasswordValid($TestForPassowrd,$_POST["Password"])) {
      echo 'Password True <br>';
      echo date('h:i:s:ns') . "<br>";
    }
    else {
      echo 'Password False <br>';
      echo date('h:i:s:ns') . "<br>";
    }
  }
  
  function PasswordValid($TestForPassowrd, $Password) {
    return hash_equals($TestForPassowrd, $Password);
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>User Login</title>
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
          <li><a href="index.html" title="home">Home</a></li>
          <li id="currentPage"><a href="login.php" title="Login">Login</a></li>
          <li><a href="register.php" title="Register">Register</a></li>
          <?php 
            if (isset($_SESSION["admin"])) {
                echo "
                <li><a href = 'pageOne.html' title = 'pageOne'>PageOne</a></li>
                <li><a href = 'pageTwo.html' title = 'pageTwo'>pageTwo</a></li>
                ";
            }
            if ($_SESSION["loggedIn"] == True) {
                echo "
                <li><a href = 'main.php' title = 'Main'>Main</a></li>
                <li><a href = 'logout.php' title = 'Logout'>Logout</a></li>
                ";
            }
            ?>
        </ul>
      </div>
    </nav>
    <main id = "mainArea">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <h2>Login</h2>
        <p>Please enter your login information below.</p>
        <div class="inputbox">
            <label for="username">Username:</label>
            <input autofocus type="text" placeholder="username" name="username" id="username" />
        </div><!-- End of username -->
        <div class="inputbox">
            <label for="password">Enter Password:</label>
            <input type="password" placeholder="*********" name="password" id="password"></input>
        </div><!-- End of password -->

        <div class="buttons">
            <input type="submit" value="Send Form" name="submit" id="submit"></input>
            <input type="reset" value="Clear Form" name="reset"></input>
        </div> <!-- End of Submit/Clear -->        
      </form>
    </main>
  </body>
</html>