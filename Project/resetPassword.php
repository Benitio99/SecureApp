<?php
    include_once("header.php");
    include_once("registerProcess.php");

?>
<!DOCTYPE html>
<html>

    <head>
        <title>User Registration</title>
        <link href="styles/project.css" rel="stylesheet">
        </link>
        <script src="scripts/inputProcessing.js"></script>
        <script src="scripts/passwordComplexity.js"></script>
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
                    <li><a href="index.php" title="Home">Home</a></li>
                    <li><a href="register.php" title="Register">Register</a></li>
                    <li><a href="login.php" title="Login">Login</a></li>
                    <?php 
                    if (isset($_SESSION["isAdmin"])) {
                        if ($_SESSION["isAdmin"]== true) {
							echo "
							<li><a href = 'pageOne.html' title = 'pageOne'>PageOne</a></li>
							<li><a href = 'pageTwo.html' title = 'pageTwo'>pageTwo</a></li>
							";
                        }
                    }
                    if (isset($_SESSION["loggedIn"])) {
                        if ($_SESSION["loggedIn"]== true) {
                            echo "
                            <li><a href = 'main.php' title = 'Main'>Main</a></li>
                            <li id = 'currentPage'><a href = 'resetPassword.php' title = 'ResertPassword'>Reset Password</a></li>
                            <li><a href = 'logout.php' title = 'Logout'>Logout</a></li>
                            ";
                        } 
                    }
                    ?>
                </ul>
            </div>
        </nav>
        <main id = "mainArea">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="GET">
                <h2>Reset Password</h2>
                <p>Please fill out this form to reset your password.</p>
                <div class="inputbox">
                    <label for="passwordOne">Enter Password:</label>
                    <span class = "warningInfo" id = "passwordOneInfo" name = "passwordOneInfo"></span>
                    <input onkeyup="checkPasswordComplexity(this.value)" type="password" placeholder="*********"
                        name="passwordOne" id="passwordOne">
                    <span class = "extraInfo">Please use the following characters <u>only</u>: 0-9, a-z, A-Z, !, ? @, _, -</span>
                </div><!-- End of passwordOne -->
                <div class="inputbox">
                    <label for="passwordTwo">Re-Enter Password:</label>
                    <span class = "warningInfo" id = "passwordTwoInfo" name = "passwordTwoInfo"></span>
                    <input onkeyup="checkPasswordsMatch(this.value)" type="password" placeholder="*********" name="passwordTwo"
                        id="passwordTwo">
                    <span class = "extraInfo">Please match password <u>exactly</u></span>
                </div><!-- End of passwordTwo -->
				<input type="hidden" name="CSRFToken" id="CSRFToken" value="<?php setCSRFToken(); ?>">
                <div class="buttons">
                    <input disabled="true" type="submit" value="Reset" name="submit" id="submit"></input>
                    <input type="reset" value="Clear" name="reset"></input>
                </div> <!-- End of Submit/Clear -->
            </form>
			<aside>
                <div class="asideChecks">
                    <input disabled type="checkbox" name="okPassword" id="okPassword" />
                    <label for="okPassword">Password OK</label>
                </div>
                <div class="asideChecks">
                    <input disabled type="checkbox" name="passwordLength" id="passwordLength" />
                    <label for="passwordLength">Password Length min: 8</label>
                </div>
                <div class="asideChecks">
                    <input disabled type="checkbox" name="alphabetUpper" id="alphabetUpper" />
                    <label for="alphabetUpper">Uppercase characters</label>
                </div>
                <div class="asideChecks">
                    <input disabled type="checkbox" name="alphabetLower" id="alphabetLower" />
                    <label for="alphabetLower">Lowercase characters</label>
                </div>
                <div class="asideChecks">
                    <input disabled type="checkbox" name="numeric" id="numeric" />
                    <label for="numeric">Numerical characters</label>
                </div>
                <div class="asideChecks">
                    <input disabled type="checkbox" name="specialChars" id="specialChars" />
                    <label for="specialChars">Special Chars</label>
                </div>
                <div class="asideChecks">
                    <input disabled type="checkbox" name="noBadChars" id="noBadChars" />
                    <label for="noBadChars">No Bad Chars</label>
                </div>
                <div class="asideChecks">
                    <input disabled type="checkbox" name="passwordMatch" id="passwordMatch" />
                    <label for="passwordMatch">Matching Passwords</label>
                </div>
            </aside>
        </main>
    </body>
</html>