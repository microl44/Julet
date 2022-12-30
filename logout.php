<?php 
session_start();
require_once "loginFunctions.php";
require_once "includers/header.php";

if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    addLog("Logged out");
    header('location: ' . $_POST['url2']);
    die();   
}
?>