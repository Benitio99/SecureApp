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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <h2>Registration Form</h2>
        <p>Please fill out this form to register with our site.</p>
        <div class="inputbox">
            <label for="username">Username:</label>
            <input onblur="processInput(this.value)" autofocus type="text" placeholder="username" name="username"
                id="username" />
        </div><!-- End of username -->
        <div class="inputbox">
            <label for="firstName">First Name:</label>
            <input onblur="processInput(this.value)" type="text" placeholder="John" name="firstName" id="firstName" />
        </div><!-- End of firstName -->
        <div class="inputbox">
            <label for="surname">Last Name:</label>
            <input onblur="processInput(this.value)" type="text" placeholder="Smith" name="surname" id="surname" />
        </div><!-- End of surname -->
        <div class="inputbox">
            <label for="email">E-mail:</label>
            <input onblur="processInput(this.value)" type="email" id="email" placeholder="someone@somewhere.ie"
                name="email" />
        </div> <!-- End of Email -->
        <div class="inputbox">
            <label for="passwordOne">Enter Password:</label>
            <input onkeyup="checkPasswordComplexity(this.value)" type="password" placeholder="*********"
                name="passwordOne" id="passwordOne">
        </div><!-- End of passwordOne -->
        <!-- onblur="checkPasswordComplexity()" -->
        <div class="inputbox">
            <label for="passwordTwo">Re-Enter Password:</label>
            <input onkeyup="checkPasswordsMatch(this.value)" type="password" placeholder="*********" name="passwordTwo"
                id="passwordTwo">
        </div><!-- End of passwordTwo -->
        <div class="buttons">
            <button disabled="true" type="submit" value="Send Form" name="submit" id="submit">Submit</button>
            <button type="reset" value="Clear Form" name="reset">Reset</button>
        </div> <!-- End of Submit/Clear -->
    </form>
    <aside>
        <div>
            <p>Please use only the following characters <u>only</u>:<br>0-9, a-z, A-Z, !, ? @, _, -</p>
        </div>
        <div class="asideChecks">
            <label for="okPassword">Password OK</label>
            <input disabled type="checkbox" name="okPassword" id="okPassword" />
        </div>
        <div class="asideChecks">
            <label for="passwordLength">Password Length min: 8</label>
            <input disabled type="checkbox" name="passwordLength" id="passwordLength" />
        </div>
        <div class="asideChecks">
            <label for="alphabetUpper">Uppercase characters
                <input disabled type="checkbox" name="alphabetUpper" id="alphabetUpper" />
            </label>
        </div>
        <div class="asideChecks">
            <label for="alphabetLower">Lowercase characters
                <input disabled type="checkbox" name="alphabetLower" id="alphabetLower" />
            </label>
        </div>
        <div class="asideChecks">
            <label for="numeric">Numerical characters
                <input disabled type="checkbox" name="numeric" id="numeric" />
            </label>
        </div>
        <div class="asideChecks">
            <label for="specialChars">Special Chars
                <input disabled type="checkbox" name="specialChars" id="specialChars" />
            </label>
        </div>
        <div class="asideChecks">
            <label for="noBadChars">No Bad Chars
                <input disabled type="checkbox" name="noBadChars" id="noBadChars" />
            </label>
        </div>
        <div class="asideChecks">
            <label for="noWords">No words
                <input disabled type="checkbox" name="noWords" id="noWords" />
            </label>
        </div>
        <div class="asideChecks">
            <label for="passwordMatch">Matching Passwords
                <input disabled type="checkbox" name="passwordMatch" id="passwordMatch" />
            </label>
        </div>
    </aside>
</body>

</html>