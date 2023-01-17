<?php 
if(!isset($_SESSION))
{ session_start(); }

require_once "includers/basic.php";
require_once "Database.php";    

echo $_SESSION['username'];
echo $_COOKIE['username'];
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
    LoginAttempt($_POST['username'],$_POST['password']);

    unset($_POST['username']);
    unset($_POST['password']);

    addLog("Logged In");
    
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
        $conn = new PDO(getConnectionString(),$username,$password);

        setcookie('username', $username, time() + 2592000);
        setcookie('password', $password, time() + 2592000);
        setcookie('ShouldBeLoggedIn', true, time() + 2592000);

        if(!isset($_SESSION['SessionStarted']))
        {
            addLog("Started Session");
            $_SESSION['SessionStarted'] = true;
        }
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        return true;
    }
    catch(Exception $e){
        print_r($e);
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