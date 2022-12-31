<?php 
if(!isset($_SESSION))
{
	session_start();
}
require_once "loginFunctions.php";
require_once "includers/header.php";

if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    addLog("Logged out");
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header('location: ' . $_POST['url2']);
    die();   
}
?>