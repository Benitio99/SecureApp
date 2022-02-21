<?php

/**
*
*/
class USER {
    private $db;

    //Constructor
    function __construct($connection) {
        $this->database=$DBcon;
    }

    //Login
    public function login($name,$pass) {
        try {
            $stmt=$this->db->prepare("SELECT * from " . TABLE . " WHERE username=:username");
            $stmt->execute(':username=>$username');
            $data=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount()>0) {
                if(password_verify($pass, $data['password'])) {
                    return true;
                }
            }
        }
        catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    //Signup
    public function signup($name,$password,$mobile) {
        try {
            $new_password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
            $stmt=$this->db->prepare("INSERT into register(name,password,mobile) VALUES(:name , :pass , :mobile)");

            if($stmt->execute(array(':name'=>$name , ':pass'=>$new_password, ':mobile'=>$mobile))) {
                return $stmt;
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Logout
    public function logout() {
        session_destroy();
        unset($_SESSION[‘name’]);
        return true;
    }

    //Logged in
    public function is_loggedin() {
        if(isset($_SESSION[‘name’])) {
            return true;
        }
    }

    //Redirect
    public function redirect($url) {
        header(“Location: $url”);
    }
}
?>