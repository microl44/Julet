<?php 
require_once "includers/header.php";
if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header('location:' . 'index.php');
    die();   
}
else{
    echo "<br/><br/><br/><br/><br/><h1>mother fucker suck my dick why are you like this??? fuck PHP</h1>";
}
?>