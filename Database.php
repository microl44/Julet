<?php
$dbname = "";
$host = "";
$port = "";
$tempUser = "";
$tempPassword = "";
function getConnectionString()
{
   return "mysql:dbname=".$jul.";host=".host.";port=".$port;
}

function CreateConn()
{
  if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
  }
  else{
    $username = $tempUser;
    $password = $tempPassword;
    
    $conn = newPDO(getConnectionString(), $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $conn;
  }
}
?>
