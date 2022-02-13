<?php
  require_once 'header.php';
  include("loginProcess.php");
  echo date('h:i:s:ns') . "<br>";
  /*
  IF DB_ID('dms') IS NOT NULL
  --code mine :)
  print 'db exists'

  system("cmd /c start.bat");

  */
  if (isset($_POST["Password"])) {
    $unsanitisedPassword = 
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
    </head>
    <body>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <h2>Login</h2>
            <p>Please enter your login information below.</p>
            <div class="inputbox">
                <label for="username">Name:</label>
                <input autofocus type="text" placeholder="username" name="username" id="username" />
            </div><!-- End of username -->
            <div class="inputbox">
                <label for="password">Enter Password:</label>
                <input type="password" placeholder="*********" name="password" id="password"></input>
            </div><!-- End of password -->

            <div class="buttons">
                <button type="submit" value="Send Form" name="submit">Submit</button>
                <button type="reset" value="Clear Form" name="reset">Reset</button>
            </div> <!-- End of Submit/Clear -->

        </form>
    </body>
</html>