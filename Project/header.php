<?php
session_start();
if( isset( $_SESSION['visitDuration'] ) ) {
    $_SESSION['counter'] += 1;
 }else {
    $_SESSION['counter'] = 1;
 }
$currentMinute = date("i");
$currentHour = date("H");

?>