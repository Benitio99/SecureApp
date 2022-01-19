<?php
  require_once 'header.php';


  echo date('h:i:s:ns') . "<br>";

  if (isset($_POST["Password"])) {
    If(PasswordValid($TestForPassowrd,$_POST["Password"]))
	{
		echo 'Password True <br>';
		echo date('h:i:s:ns') . "<br>";
	}
	else
	{
		echo 'Password False <br>';
		echo date('h:i:s:ns') . "<br>";
	}
  }
  
  
  function PasswordValid($TestForPassowrd, $Password) {
	time_nanosleep(1,0); //ns delay inserted to simulate processing 
	return hash_equals($TestForPassowrd, $Password);
}

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  Enter Password:<input type="Password" name="Password" />
  <input type="submit" name="submit"/>

</html>