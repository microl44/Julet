<?php 
if(!isset($_SESSION))
{ session_start(); }

require_once "includers/basic.php";
require_once "Database.php";    

if(isset($_POST['url']))
{
    $previousPage = $_POST['url'];
}
else
{
    $previousPage = "index.php";
}

if(isset($_POST['username']))
{
    if(LoginAttempt($_POST['username'],$_POST['password']))
    {
        unset($_POST['username']);
        unset($_POST['password']);
        $_SESSION['logged-in'] = true;
        addLog("Logged In");
    }
    
    header('location: ' . $previousPage);
    die();
}

else if (isset($_POST['user']) && isset($_POST['pass']))
{
    $previousPage = $_POST['URL'];

    if(UserLogin($_POST['user'], $_POST['pass']))
    {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $_POST['user'];
        header('location: ' . $previousPage);
        die();
    }
    else{
        $_SESSION['login_error'] = "Wrong username or password";
        header('location: ' . $previousPage);
        die();
    }
}

function LoginAttempt($username, $password)
{
    try
    {
        $conn = GetConn();

        $stmt = $conn->prepare("SELECT * FROM users WHERE password = :password AND username = :username LIMIT 1;");
        $stmt->bindvalue(':username', $username);
        $stmt->bindvalue(':password', $password);

        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            if(!isset($_SESSION['logged-in']))
            {
                addLog("Started Session");
            }
            
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            return true;
        }
        else
        {
            return false;
        }
    }
    catch(Exception $e){
        return false;
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

function UserLogin($username, $password)
{
    $conn = GetConn();

    $stmt = $conn->prepare("SELECT * FROM users where username = :username AND password = :password");

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    $stmt->execute();
    $results = $stmt->fetch();

    if(exists($results))
    {
        $_SESSION['user'] = $username;
        return true;
    }
    else {
        return false;
    }
}

?>