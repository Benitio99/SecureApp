<?php
require("header.php");
require("registerProcess.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link href="styles/project.css" rel="stylesheet">
    </link>
    <script src="scripts/inputProcessing.js"></script>
    <script src="scripts/passwordComplexity.js"></script>
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
                <li id="currentPage"><a href="index.html" title="Pierce">Home</a></li>
                <li><a href="programming.html" title="Programming">Programming</a></li>
                <li><a href="gaming.html" title="Gaming">Gaming</a></li>
                <li><a href="music.html" title="Music">Music</a></li>
                <li><a href="logout.html" title="Logout">Logout</a></li>
            </ul>
        </div>
    </nav>		
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="GET">
        <h2>Registration Form</h2>
        <p>Please fill out this form to register with our site.</p>
        <div class="inputbox">
            <label for="username">Username:</label>
            <input onblur="processInput(this.value)" autofocus type="text" placeholder="username" name="username"
                id="username" required/>
            <span class = "extraInfo" id = "usernameInfo" name = "usernameInfo">This value must be unique in our database.</span>
        </div><!-- End of username -->
        <div class="inputbox">
            <label for="firstName">First Name:</label>
            <input onblur="processInput(this.value)" type="text" placeholder="John" name="firstName" id="firstName" required/>
        </div><!-- End of firstName -->
        <div class="inputbox">
            <label for="surname">Last Name:</label>
            <input onblur="processInput(this.value)" type="text" placeholder="Smith" name="surname" id="surname" required/>
        </div><!-- End of surname -->
        <div class="inputbox">
            <label for="email">E-mail:</label>
            <input onblur="processInput(this.value)" type="email" id="email" placeholder="someone@somewhere.ie"
                name="email" required/>
            <span class = "extraInfo" id = "usernameInfo" name = "usernameInfo">Must contain the @ symbol</span>
        </div> <!-- End of Email -->
        <div class="inputbox">
            <label for="passwordOne">Enter Password:</label>
            <span class = "warningInfo" id = "passwordOneInfo" name = "passwordOneInfo"></span>
            <input onkeyup="checkPasswordComplexity(this.value)" type="password" placeholder="*********"
                name="passwordOne" id="passwordOne">
            <span class = "extraInfo">Please use the following characters <u>only</u>: 0-9, a-z, A-Z, !, ? @, _, -</span>
        </div><!-- End of passwordOne -->
        <!-- onblur="checkPasswordComplexity()" -->
        <div class="inputbox">
            <label for="passwordTwo">Re-Enter Password:</label>
            <span class = "warningInfo" id = "passwordTwoInfo" name = "passwordTwoInfo"></span>
            <input onkeyup="checkPasswordsMatch(this.value)" type="password" placeholder="*********" name="passwordTwo"
                id="passwordTwo">
            <span class = "extraInfo">Please match password <u>exactly</u></span>
        </div><!-- End of passwordTwo -->
        <div class="buttons">
            <input disabled="true" type="submit" value="Send Form" name="submit" id="submit"></input>
            <input type="reset" value="Clear Form" name="reset"></input>
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
            <input disabled type="checkbox" name="noWords" id="noWords" />
            <label for="noWords">No words</label>
        </div>
        <div class="asideChecks">
            <input disabled type="checkbox" name="passwordMatch" id="passwordMatch" />
            <label for="passwordMatch">Matching Passwords</label>
            
        </div>
    </aside>
</body>

</html>