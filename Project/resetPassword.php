<?php
require_once("header.php");

if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
    header("location: login.php");
    exit;
  }

?>