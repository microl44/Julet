<?php 
if(!isset($_SESSION))
{
	session_start();
}
require_once "includers/basic.php";
require_once "loginFunctions.php";

if(isset($_SESSION['user']) && isset($_SESSION['loggedIn']))
{
	unset($_SESSION['user']);
	$_SESSION['logged-in'] = false;
}

#log activity, unset session variables, unset cookies and redirect to previous page.
if(isset($_SESSION['username']) || isset($_SESSION['password']))
{
    addLog("Logged out");

    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['SessionStarted']);
    $_SESSION['logged-in'] = false;

    setcookie('username', '', time()-3600, '/');
    setcookie('password', '', time()-3600, '/');
    setcookie('logged-in', '', -(time()+3600), '/');

    header('location: ' . $_POST['url']);
    die();   
}
?>