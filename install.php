<?php
if(!file_exists('./Database.php')){
    echo'<h1> in the if statement </h1>';
    $myfile = fopen('Database.php','w');
    $txt = '<?php
        function getConnectionString(){
            return "mysql:host=localhost;dbname=Jul";
        };?>';
    fwrite($myfile,$txt);
    fclose($myfile);
}

include_once "Database.php";
include_once 'login.php';

function GetConnectionInstall($user,$pass){
    $conn = new PDO("mysql:host=localhost", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    try{
        $conn = GetConnectionInstall($_SESSION['username'],$_SESSION['password']);    
        
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