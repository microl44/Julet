<?php
require_once "includers/header.php";
require_once "Database.php";
require_once "function.php";
//init vars
$conn = createConn();

$stmt = $conn->query("SELECT name FROM participant ORDER BY name");
$participants = $stmt->fetchAll();

$stmt = $conn->query("SELECT name FROM genre ORDER BY name");
$genres = $stmt->fetchAll();

echo "<body>";
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

  echo "<form action='index.php' method='POST'>";
  echo "<label for='searchGenre'>Search by Genre: </lable>";
  echo "<input type='string' name='searchGenre'/>";
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
  else if(isset($_POST['searchGenre'])){
    $sql = "SELECT * FROM movie WHERE genre_name LIKE :input";
    $stmp = $conn->prepare($sql);
    $temp = "%" . $_POST['searchGenre'] ."%";
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
    
    echo "<div class='addMovieDiv'>";
    echo "<div class='addMovieDivFirst'>";
      echo "<form action='query.php' method='POST'>";
        echo "<label> Name: </label>";
        echo "<input type='text' name='addName' required/> <br/>";

        echo "<label for='addGenre'> Genre: </label>";
        echo "<select name='addGenre'>";
          foreach($genres as $genre)
          {
            echo "<option>" . $genre[0] . "</option>";
          }
        echo "</select> <br/>";

        echo "<input type='text' name='addIMDB' requred /> <br/>";

        echo "<label for='addjayornay'> Jay or Nay </label>";
        echo "<input type='text' name='addjayornay' requred /> <br/>";
    echo "</div>";
      echo "<div class='addMovieDivSecond'>";
        echo "<label for='addPickedBy'> Picked By: </label>";
        echo "<select name='addPickedBy'>";
          foreach($participants as $participant)
          {
            echo "<option>" . $participant[0] . "</option>";
          }
        echo "</select> <br/>";

        echo "<label for='addParticipants'> Participants </label>";
        echo "<input type='text' name='addParticipants' requred /> <br/>";

        echo "<label for='addIs_major'>WheelType </label>";
        echo "<select name='addIs_major' type='number'> <br/>";

          echo "<option value='1'> Big Wheel </option>";
          echo "<option value='0'> Small Wheel </option>";
          echo "</select> </br>";

        echo "<input id='addMovieBtn' type='submit' value='add movie'/>";
      echo "</div>";
    echo "</form>";
  echo "</div>";
  // form end

  include "includers/footer.php";
echo "</body>";
?>
