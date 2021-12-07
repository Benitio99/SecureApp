<html lang="en">
<!-- https://hackersonlineclub.com/command-injection-cheatsheet/

Objectives
1. Obtain the directory structure on the server
2. obtain the network configuration of the server
3. Upload a file that will execuite on the server (.php file parhaps)
4. Run the file 
5. Fix the vulnerable code  -->

<head></head>
<body>

<p>Enter your IP/host to ping.  
            <form method='get' action=''>
                <div class="form-group"> 
                    <label></label>
                    <input class="form-control" width="50%" placeholder="" name="target"></input> <br>
                    <div align="left"> <button class="btn btn-default" type="submit">Submit Button</button></div>
               </div> 
            </form>
</p>

<?php
    if (isset($_REQUEST['target'])) {
        $target = $_REQUEST['target'];
        $target = str_pad($target, strlen($target), ")^(*", STR_PAD_BOTH);
        //echo &target;
        $ipPattern = '/[0-9]{0,3}\.[0-9]{0,3}\.[0-9]{0,3}\.[0-9]{0,3}/';
        if (preg_match($ipPattern, $target, $matches) == 1){
            if($target){
                if (stristr(php_uname('s'), 'Windows NT')) { 
                    
                    $cmd = shell_exec( 'ping  ' . $target );
                    echo '<pre>'.$cmd.'</pre>';
        
                } else { 
                    $cmd = shell_exec( 'ping  -c 3 ' . $target );
                    echo '<pre>'.$cmd.'</pre>';
                }
            }
        }
        else {
            echo "<h3 color = 'red'>Please input a valid IPV4 format<h3/>";
        }    
    }     
?>
			
</body>

</html>