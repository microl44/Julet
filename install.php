<?php
include_once "includers/header.php";
include_once "Database.php";

try{
	$conn = CreateConn();
    $stmp = $conn->prepare(file_get_contents('Shared/DatabaseInstallScript/CREATETABLESINSERTDATA.sql'));
    $stmp->execute();
    foreach($stmp->fetchall() as $row){print_r($row);}
    echo "<br/><br/><br/><h1> we good boizzzzz</h1>";
}
catch(Exception $e){
    echo "<h1> ooh fuck ooh shit ooh fuck </h1>";
}
?>