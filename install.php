<?php
include "includers/header.php";
include "Shared/connection.php";

try{
    $stmp = $conn->prepare(file_get_contents('Shared/DatabaseInstallScript/CREATETABLESINSERTDATA.sql'));
    $stmp->execute();
    foreach($stmp->fetchall() as $row){print_r($row);}
    echo "<h1> we good boizzzzz</h1>";
}
catch(Exception $e){
    echo "<h1> ooh fuck ooh shit ooh fuck </h1>";
}

?>