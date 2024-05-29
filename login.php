<?php
if(!isset($_SESSION))
{session_start();}

require_once "../includers/basic.php";
require_once "../loginFunctions.php";

if(isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['ShouldBeLoggedIn']) && $_COOKIE['ShouldBeLoggedIn'] != false)
{
    #LoginAttempt($_COOKIE['username'], $_COOKIE['password']);
}

if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true)
{
    echo "<form action='../logout.php' method='POST'>";
        echo "<input class='navbarLink logoutBtn' type='submit' value='LOGOUT'/>";
        echo "<input type='hidden' value='".$_SERVER['REQUEST_URI']."' name='url'> </input>";
    echo "</form>";
}

else
{
    ?>
    <form action='../loginFunctions.php' method='POST'>
        <div class='loginFormFirst'>
            <label for='username'>Username:</label>
            <input id='login-username' type='text' name='username'/>
        </div>
        <div class='loginFormSecond'>
            <label for='password'>Password:</label>
            <input id='login-password' type='password' name='password'/>
        </div>
        <input id='login-submit' class='loginBtn' type='submit' value='login'/> 

        <?php echo "<input type='hidden' value='" . $_SERVER['REQUEST_URI'] . "' name='url'> </input>"; ?>
    </form>
    <?php
}
?>