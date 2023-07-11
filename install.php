<?php 
if(!isset($_SESSION))
{
    session_start();
}

if(!file_exists('./Database.php')){

    $myfile = fopen('Database.php','w');
    $txt = '<?php
        function getConnectionString(){
            return "mysql:host=localhost;dbname=Jul";
        };?>';
    fwrite($myfile,$txt);
    fclose($myfile);
}

require_once "includers/basic.php";
include_once "Database.php";
include_once "loginFunctions.php";

function actualInstall(){
    try{
        $conn = GetConn();
        $conn->query("CREATE DATABASE IF NOT EXISTS Jul;");
        
        $stmp = $conn->prepare(file_get_contents('Shared/DatabaseInstallScript/CREATETABLESINSERTDATA.sql'));
        $stmp->execute();
        foreach($stmp->fetchall() as $row){print_r($row);}
        $stmp->closeCursor();
        
        $stmp = $conn->prepare(file_get_contents('Shared/DatabaseInstallScript/Procedures.sql'));
        $stmp->execute();
        foreach($stmp->fetchall() as $row){print_r($row);}
        $stmp->closeCursor();
        addLog("Reinstalled Database");
        
        header('Location: pages/index.php');
    }
    catch(Exception $e){
        echo "<h1> ooh fuck ooh shit ooh fuck </h1>";
        echo $e->getmessage();
    }
}

if(isset($_SESSION['username']) || isset($_SESSION['password']))
{
    $conn = DBConn();
    $conn->query("CREATE DATABASE IF NOT EXISTS Jul;");
    actualInstall();
}
else if(isset($_POST['username']) AND isset($_POST['password']))
{
    global $conn;   
    $conn = DBConn();
    $conn->query("CREATE DATABASE IF NOT EXISTS Jul;");

    LoginAttempt($_POST['username'], $_POST['password']);
    actualInstall();
}
else{
    echo "<br/><br/><br/><br/><br/><br/>";
    echo "<form action='install.php' method='POST'>";
    echo "<label for='username'>Username :</lable>";
    echo "<input type='text' name='username'/>";
    echo "<label for='password'>Password :</lable>";
    echo "<input type='password' name='password'/>";
    echo "<input type='submit' value='login'/>" ;
    echo "</form>";
}
?>
