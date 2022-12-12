<?php session_start(); ?>
<?php 
require_once "Database.php";

function LoginAttempt($username, $password){
    try{
        $connection = new PDO(getConnectionString(),$username,$password);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['LoginFail'] = False;
        header("Refresh:0");
    }
    catch(Exception $e){
        $_SESSION['LoginFail'] = True;
        header("Refresh:0");
    }
}

function GetConnection(){
    $conn = new PDO(getConnectionString(), $_SESSION['username'], $_SESSION['password']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function notLoggedIn(){
    echo "<body>";
        echo "<div class='content'>";
          echo "<h1>Please login to view the Christmas_Tree.png</h1>";
        echo "</div>";
    echo "</body>";
}
?>