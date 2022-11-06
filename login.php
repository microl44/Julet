<?php
require_once "loginFunctions.php";
require_once "includers/header.php";

if(isset($_POST['username'])){
    LoginAttempt($_POST['username'],$_POST['password']);
    header('location: ./index.php');
    die();
}
?>
<form action='login.php' method='POST'>
    <label for='username'>Username :</lable>
    <input type='text' name='username'/>
    <label for='password'>Password :</lable>
    <input type='password' name='password'/>
    <input type='submit' value='login'/> 
</form>
