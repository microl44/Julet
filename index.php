<?php
include "includers/header.php";
include "Database.php";
include "function.php";

if(isset($_POST['addName'])){
  try
  {
    $sql = "INSERT INTO movie(name, genre_name, imdb_rating, jayornay, picked_by, participants, is_major)";
    $sql = $sql . "VALUES(:addName,:addGenre,:addIMDB,:addjayornay,:addPickedBy,:addParticipants,:addIs_major);";
    
    $stmp = $conn->prepare($sql);
    $stmp->bindvalue(':addName',$_POST['addName']);
    $stmp->bindvalue(':addGenre',$_POST['addGenre']);
    $stmp->bindvalue(':addIMDB',$_POST['addIMDB']);
    $stmp->bindvalue(':addjayornay',$_POST['addjayornay']);
    $stmp->bindvalue(':addPickedBy',$_POST['addPickedBy']);
    $stmp->bindvalue(':addParticipants',$_POST['addParticipants']);
    $stmp->bindvalue(':addIs_major',$_POST['addIs_major']);

    if(!$stmp->execute())
    {
      throw new Exception("unknown error");
    }
  }
  catch(Exception $e)
  {
    echo "<h3> Insert was fucky wucky, insert died</h3>";
    echo "message: " . $e->getMessage();
  }

}

// serach for winner of wheel
echo "<form action='index.php' method='POST'>";
echo "<label for='input'>Search by winner: </lable>";
echo "<input type='string' name='searchByWinner'/>";
echo "<input type='submit' value='Search'/>";
echo "</form>";
// form end

echo "<form action='index.php' method='POST'>";
echo "<label for='searchParticipants'>Search by Participant: </lable>";
echo "<input type='string' name='searchParticipants'/>";
echo "<input type='submit' value='Search'/>";
echo "</form>";

//show table
if(isset($_POST['searchByWinner']))
{
  $sql = "SELECT * FROM movie WHERE picked_by LIKE :input";
  $stmp = $conn->prepare($sql);
  $temp = "%" . $_POST['searchByWinner'] ."%";
  $stmp->bindvalue(":input",$temp);
  $result = $stmp->execute();
  PrintMovieTable($result,$stmp);
}
else if(isset($_POST['searchParticipants'])){
  $sql = "SELECT * FROM movie WHERE participants LIKE :input";
  $stmp = $conn->prepare($sql);
  $temp = "%" . $_POST['searchParticipants'] ."%";
  $stmp->bindvalue(":input",$temp);
  $result = $stmp->execute();
  PrintMovieTable($result,$stmp);
}
else
{
  $sql = "SELECT * FROM movie ORDER BY id";
  $stmp = $conn->prepare($sql);
  $result = $stmp-> execute();
  PrintMovieTable($result,$stmp);
}
// show table end

// insert new movie form
echo "<h3>Add new movie </h3>";
echo "<form action='index.php' method='POST'>";

echo "<label for='addName'> Name</label>";
echo "<input type='string' name='addName' required/> ";

echo "<label for='addGenre'> Genre </label>";
echo "<input type='string' name='addGenre' requred /> <br/>";

echo "<label for='addIMDB'> IMDB Grade </label>";
echo "<input type='string' name='addIMDB' requred /> ";

echo "<label for='addjayornay'> Jay or Nay </label>";
echo "<input type='string' name='addjayornay' requred /> <br/>";

echo "<label for='addPickedBy'> Picked BY </label>";
echo "<input type='string' name='addPickedBy' requred /> ";

echo "<label for='addParticipants'> Participants </label>";
echo "<input type='string' name='addParticipants' requred /> <br/>";

echo "<label for='addIs_major'>WheelType </label>";
echo "<select name='addIs_major'>";
echo "<option value='1'> Big Wheel </option>";
echo "<option value='0'> Small Wheel </option>";

echo "<input type='submit' value='add movie'/>";
echo "</form>";
// form end

include "includers/footer.php";
?>
