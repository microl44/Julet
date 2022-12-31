<?php 
if(!isset($_SESSION))
{ session_start(); }

require_once "includers/basic.php";
require_once "Database.php";
require_once "includers/header.php";

if(isset($_POST['username']))
{
    LoginAttempt($_POST['username'],$_POST['password']);
    header('location: ' . $_POST['url']);
    die();
}

function LoginAttempt($username, $password)
{
    try
    {
        $connection = new PDO(getConnectionString(),$username,$password);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        addLog("Logged In");
        return true;
    }
    catch(Exception $e){
        notLoggedIn();
    }
}

function notLoggedIn(){
    echo "<body>";
        echo "<div class='content'>";
          echo "<h1>Please login to view the Christmas_Tree.png</h1>";
        echo "</div>";
    echo "</body>";
}

function GeneratePasswordHash($password, $algorithm = "PASSWORD_DEFAULT")
{
    if(!isset($password))
    {
        return null;
    }

    $password = password_hash($password, $algorithm);
    return $password;
}

?>