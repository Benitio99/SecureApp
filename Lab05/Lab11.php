<!DOCTYPE html>
<html>
<head>

<?php require_once 'header.php'; ?>

</head>
<style>
* {
  box-sizing: border-box;
}

.header, .footer {
  background-color: grey;
  color: white;
  padding: 15px;
}

.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

.content {
  width: 75%;
}

button {
  width: 160px;
  height: 30px;
}

</style>
</head>
  <body>
    <div class="header">
      <h1>Session Lab Exercise</h1>
    </div>
    <div class="clearfix">
      <div class="column content">
        <h1>Session Destruction</h1>
        <p></p>
      </div> 
      <div class="column content">
        <form action="" method="POST">
        <?php
          $IPAddress = $_SERVER["REMOTE_ADDR"];
          $userAgent = $_SERVER["HTTP_USER_AGENT"];
          session_start();
          $_SESSION['session_ID'] = session_id();
          $_SESSION['numberValue'] = $_SESSION['numVal'] ;
          $_SESSION['newSession_ID'] = null;
          $_SESSION['numVal'] = 0;
          $_SESSION['newNumVal'] = null;
          
          
          echo "<div>
                  <p>";
                  if(isset($_POST['Destroy Session'])) {
                    echo "Destroy Session.....";
                    destroySession();
                  }
                  else if(isset($_POST['Regenerate Session ID'])) {
                    echo "Regenerate Session.....";
                    regenerateSession();
                  }
              echo "<br>
                    IP Address: $IPAddress<br>
                    User Agent: $userAgent<br>
                    Original Session ID: " . $_SESSION['session_ID'] . " <br>
                    Generated Session: " . $_SESSION['newSession_ID'] . " <br>
                    Old numVal: " . $_SESSION['numVal'] . " <br>
                    New numVal: " . $_SESSION['newNumVal'] . " <br>
                  <p>
                </div>";
                function regenerateSession(){
                  $_SESSION['newSession_ID'] = session_id();
                  $_SESSION['session_ID'] = $_SESSION['newSession_ID'];
                  $_SESSION['newSession_ID'] = session_regenerate_id();
                  $_SESSION['newNumVal'] = $_SESSION['numVal'];
                  $_SESSION['newNumVal']++;
                }
                function destroySession(){
                  session_abort();
                }
        ?>
        <input type='submit' id='Destroy Session' name='Destroy Session' value='Destroy Session'/>
        <br><br>
        <input type='submit' id='Regenerate Session ID' name='Regenerate Session ID' value='Regenerate Session ID'/>
      </form>
    </div>
    <div class="footer">
      <p>session destruction lab</p>
    </div>
  </body>
</html>
