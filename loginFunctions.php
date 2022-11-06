<?php session_start(); ?>
<?php 
require_once "Database.php";

function LoginAttempt($username, $password){
    try{
        $connection = new PDO(getConnectionString(),$username,$password);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    }
    catch(Exception $e){
        echo "<br/><br/><br/><br/><h1>Error logging in try again</h1>";
        print_r($e->getmessage());
    }
}

function GetConnection(){
    $conn = new PDO(getConnectionString(), $_SESSION['username'], $_SESSION['password']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function notLoggedIn(){
    echo "<body>";
    echo "<div id='content'>";
      echo "<h1>Please logg in first </h1>";
    echo "</div>";
    echo "</body>";
}
?>