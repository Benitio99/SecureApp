<?php


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
          <li id = "currentPage"><a href = "login.php" title = "Login">Login</a></li>
          <li><a href = "register.php" title = "Register">Register</a></li>
          <?php 
            if ($_SESSION["admin"] == True) {
                echo "
                <li><a href = 'pageOne.html' title = 'pageOne'>PageOne</a></li>
                <li><a href = 'pageTwo.html' title = 'pageTwo'>pageTwo</a></li>
                ";
            }
            if ($_SESSION["loggedIn"] == True) {
                echo "
                <li id = 'currentPage'><a href = 'main.php' title = 'Main'>Main</a></li>
                <li><a href = 'logout.php' title = 'Logout'>Logout</a></li>
                ";
            }
            ?>
        </ul>
      </div>
    </nav>
      <!--
      <nav>
        <button id="hamburger">
          <div class="bar" id="barOne"></div>
          <div class="bar" id="barTwo"></div>
          <div class="bar" id="barThree"></div>
        </button>
        <div id="navWrapper">
          <ul class="navLinks">
            <li id="currentPage"><a href="index.html" title="Pierce">Home</a></li>
            <li><a href="programming.html" title="Programming">Programming</a></li>
            <?php 
            /*
            if (isset()) {
              echo 
              '<li><a href="gaming.html" title="Gaming">Gaming</a></li>
              <li><a href="music.html" title="Music">Music</a></li>';
            }
            ?>
            <?php 
            if (isset()) {
              echo '<li><a href="logout.html" title="Logout">Logout</a></li>';
            }  
            */
            ?>
          </ul>
        </div>
      </nav>
      -->
    <main id = "mainArea">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <h2>Main Page</h2>
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