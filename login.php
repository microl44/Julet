<?php
if(!isset($_SESSION))
{
	session_start();
}
require_once "includers/basic.php";
require_once "loginFunctions.php";

if(isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['ShouldBeLoggedIn']) && $_COOKIE['ShouldBeLoggedIn'])
{
    LoginAttempt($_COOKIE['username'], $_COOKIE['password']);
}

if(isset($_SESSION['username']))
{
    echo "<form style='height: 100%;' action='logout.php' method='POST'>";
        echo "<input class='navbarLink logoutBtn' type='submit' value='LOGOUT'/>";
        echo "<input type='hidden' value='".$_SERVER['REQUEST_URI']."' name='url'> </input>";
    echo "</form>";
}
else
{?>
    <form action='loginFunctions.php' method='POST'>
        <label for='username'>Username :</lable>
        <input type='text' name='username'/>
        <label for='password'>Password :</lable>
        <input type='password' name='password'/>
        <input type='submit' value='login'/> 

        <?php echo "<input type='hidden' value='" . $_SERVER['REQUEST_URI'] . "' name='url'> </input>"; ?>
    </form>
    <?php
}
?>