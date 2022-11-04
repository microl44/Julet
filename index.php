<?php
require_once "includers/header.php";
require_once "Database.php";
require_once "function.php";
//init vars
$conn = createConn();


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
echo "<form action='query.php' method='POST'>";

  echo "<label for='addName'> Name</label>";
  echo "<input type='text' name='addName' required/> ";

  echo "<label for='addGenre'> Genre </label>";
  echo "<input type='text' name='addGenre' requred /> <br/>";

  echo "<label for='addIMDB'> IMDB Grade </label>";
  echo "<input type='text' name='addIMDB' requred /> ";

  echo "<label for='addjayornay'> Jay or Nay </label>";
  echo "<input type='text' name='addjayornay' requred /> <br/>";

  echo "<label for='addPickedBy'> Picked BY </label>";
  echo "<input type='text' name='addPickedBy' requred /> ";

  echo "<label for='addParticipants'> Participants </label>";
  echo "<input type='text' name='addParticipants' requred /> <br/>";

  echo "<label for='addIs_major'>WheelType </label>";
  echo "<select name='addIs_major' type='number'>";
  echo "<option value='1'> Big Wheel </option>";
  echo "<option value='0'> Small Wheel </option>";

  echo "<input type='submit' value='add movie'/>";
echo "</form>";
// form end

include "includers/footer.php";
?>
