<?php
require_once "loginFunctions.php";
require_once "function.php";

if(isset($_POST['pickedGenre']) && (isset($_SESSION['username']) || isset($_SESSION['password'])) ){

    $conn=GetConnection();
    $stmt = $conn->prepare("UPDATE genre SET NextGenre = 0;");
    $stmt->execute();
    $stmt->closeCursor();

    $stmt = $conn->prepare('UPDATE genre SET NextGenre = 1 WHERE name = :genre');
    $stmt->bindValue(':genre',$_POST['pickedGenre']);
    $stmt->execute();
    $stmt->closeCursor();
}

if(isset($_SESSION['username']) || isset($_SESSION['password'])){

    $conn = GetConnection();
    $stmt = $conn->prepare("SELECT name FROM genre WHERE NextGenre = 1;");

    if($stmt->execute()){
        foreach($stmt->fetchAll() as $result){ //fuck it we ball
            echo "Next Genre is :" . $result[0] ;
            break;
        }
    }
    $stmt->closeCursor();
    $conn = GetConnection();
    $stmt = $conn->prepare("SELECT name FROM genre WHERE NextGenre = 0;");
    
    if($stmt->execute()){
        echo "<form action='index.php' method='post'>";

        echo "<select name='pickedGenre'>";
        foreach($stmt->fetchAll() as $row)
        {
           echo"<option>" . $row[0] . "</option>"; 
        }
        echo "</select>";

        echo "<input type='submit' value = 'Select Genre'/>";
        echo "</form>";
    }
}
?>

