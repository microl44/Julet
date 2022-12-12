<?php 
require_once "includers/header.php";
if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header('location:' . 'index.php');
    die();   
}
else{
}
?>