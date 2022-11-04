<?php
include "includers/header.php";
include "Database.php";

if(isset($_POST['addName'])){
  try
  {
    $sql = "INSERT INTO movie(name, genre_name, imdb_rating, jayornay, picked_by, participants, is_major)
                      VALUES(:addName,:addGenre,:addIMDB,:addjayornay,:addPickedBy,:addParticipants,:addIs_major);";
    
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
echo "<label for='input'>Search for winner: </lable>";
echo "<input type='string' name='searchValue'/>";
echo "<input type='submit' value='Search'/>";
echo "</form>";
// form end

//show table
if(isset($_POST['searchValue']))
{
  $sql = "SELECT * FROM movie WHERE picked_by LIKE :input";
  $stmp = $conn->prepare($sql);
  $temp = "%" . $_POST['searchValue'] ."%";
  $stmp->bindvalue(":input",$temp);
  $result = $stmp->execute();
  printtable($result,$stmp);

}
else
{
  $sql = "SELECT * FROM movie ORDER BY id";
  $stmp = $conn->prepare($sql);
  $result = $stmp-> execute();
  printtable($result,$stmp);
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


function printtable($result,$stmp){
  if ($result)
  {
    echo "<input type='hidden' id='hejsan'> <input type='hidden'></button></input>" ;
    
    echo "<br>";
    echo "<table class='Table'>";
    echo "<tr class='TableRow'>";
    echo "<td class='TableItem TableHeader'>Nr</td>";
    echo "<td class='TableItem TableHeader'>Name</td>";
    echo "<td class='TableItem TableHeader'>Genre</td>";
    echo "<td class='TableItem TableHeader'>IMDB Grade</td>";
    echo "<td class='TableItem TableHeader'>Jay or Nay</td>";
    echo "<td class='TableItem TableHeader'>Picked By</td>";
    echo "<td class='TableItem TableHeader'>Participants</td>";
    echo "<td class='TableItem TableHeader'>Wheel Type</td>";
    echo "</tr>";
    
    while ($row = $stmp->fetch()) 
    {
      echo "<tr class='TableRow'>";
      echo "<td class='TableItem'>" . $row['id'] . "</td>";
      echo "<td class='TableItem' id='movieName'>" . $row['name'] . "</td>";
      echo "<td class='TableItem'>" . $row['genre_name'] . "</td>";
      echo "<td class='TableItem'>" . $row['imdb_rating'] . "</td>";
      echo "<td class='TableItem'>" . $row['jayornay'] . "</td>";
      echo "<td class='TableItem'>" . $row['picked_by'] . "</td>";
      echo "<td class='TableItem'>" . $row['participants'] . "</td>";
      if($row['is_major'] == 1)
      {
        echo "<td id='is_major'>Big Wheel</td>";
      }
      else
      {
        echo "<td id='is_major'>Small Wheel</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
    
  }
}

include "includers/footer.php";
?>
