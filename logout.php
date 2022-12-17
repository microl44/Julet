<?php 
session_start();
require_once "loginFunctions.php";

if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header('location: ' . $_POST['url2']);
    die();   
}
?>