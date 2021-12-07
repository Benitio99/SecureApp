"<html lang="en">
<head>
</head>
<body>
<p>Enter local address to display the contents.
<form method='get' action=''>
<div class="form-group">
<label></label>
<input class="form-control" width="50%" placeholder=""name="dir"></input>
<br>
<div align="left"> <button class="btn btn-default" type="submit">Submit Button</button></div>
</div>
</form>
</p>
<?php
if (isset($_REQUEST['dir'])) {
$dir = $_REQUEST['dir'];
echo $dir;
if ($dir){
if (stristr(php_uname('s'), 'Windows NT')) {
$cmd = shell_exec( 'dir  ' . $dir );
echo '<pre>'.$cmd.'</pre>';
}
else {
$cmd = shell_exec( 'dir  -c 3 ' . $dir );
echo '<pre>'.$cmd.'</pre>';
}
}
}
?>
</body>
</html>" 
