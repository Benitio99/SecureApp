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
	if(strlen($TestForPassowrd) != strlen($Password))
		return False;
	
	For($i=0; $i<strlen($TestForPassowrd); $i++)
	{
		if($TestForPassowrd[$i] != $Password[$i])
		{
			return False;
		}
		time_nanosleep(0,500000000); //ns delay inserted to simulate processing 
	}
	
	
	return True;
}

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  Enter Password:<input type="Password" name="Password" />
  <input type="submit" name="submit"/>

</html>