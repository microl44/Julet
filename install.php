<?php
include_once "loginFunctions.php";
include_once "includers/header.php";
include_once "Database.php";

if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    try{
        $conn = GetConnection();    
        
        $stmp = $conn->prepare(file_get_contents('Shared/DatabaseInstallScript/CREATETABLESINSERTDATA.sql'));
        $stmp->execute();
        foreach($stmp->fetchall() as $row){print_r($row);}
        $stmp->closeCursor();
        
        $stmp = $conn->prepare(file_get_contents('Shared/DatabaseInstallScript/Procedures.sql'));
        $stmp->execute();
        foreach($stmp->fetchall() as $row){print_r($row);}
        $stmp->closeCursor();
        
        echo "<br/><br/><br/> <br/><br/><br/> <h1> we good boizzzzz</h1>";
    }
    catch(Exception $e){
        echo "<br/><br/><br/> <br/><br/><br/> <h1> ooh fuck ooh shit ooh fuck </h1>";
        echo $e->getmessage();
    }
}
else{
    notLoggedIn();
}

include_once "includers/footer.php";
?>