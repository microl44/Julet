<?php 
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
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
        echo "<div class='content'>";
          echo "<h1>Please login to view the Christmas_Tree.png</h1>";
        echo "</div>";
    echo "</body>";
}
?>