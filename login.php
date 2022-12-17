<?php
session_start();
require_once "loginFunctions.php";

if(isset($_POST['username'])){
    LoginAttempt($_POST['username'],$_POST['password']);
    header('location: ' . $_POST['url']);
    die();
}
?>