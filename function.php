<?php
function PrintMovieTable($result,$stmp){
  if ($result){
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
      echo "<td class='TableItem TableHeader'> Delete Record </td>";
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
          echo "<td class='TableItem' style='border-left: 1px solid;' id='is_major'>Big Wheel</td>";
        }
        else
        {
          echo "<td class='TableItem' style='border-left: 1px solid;' id='is_major'>Small Wheel</td>";
        }
        echo "<td style='padding:0px;' class='TableItem deleteBtn'>";
          echo "<form action='query.php' method='POST'>";
            echo "<input type='hidden' name='deleteId' value='" .$row['id'] ."'/>";
            echo "<input type='submit' value='Delete this entry'/>";
          echo "</form>";
        echo "</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
}

//I'm so sorry for this, idk what I'm doing and it's 5 in the morning oh god
function PrintParticipantInfo($participant)
{
  $conn = GetConnection();
  $stmt = $conn->query("CALL GetParticipationRate('" . $participant['name'] . "')");
  $participationRate = $stmt->fetchAll();

  $conn = GetConnection();
  $stmt = $conn->query("CALL GetWinRate('" . $participant['name'] . "')");
  $winrate = $stmt->fetchAll();

  $conn = GetConnection();
  $stmt = $conn->query("CALL GetWeightedWinRate('" . $participant['name'] . "')");
  $winrateWeighted = $stmt->fetchAll();

  $conn = GetConnection();
  $stmt = $conn->query("CALL GetPickedMovies('" . $participant['name'] . "')");
  $pickedMovies = $stmt->fetchAll();

  echo "<div class='gridItem'>";
  echo "<h2 class='gridItemTitle'>" . $participant['name'] . "</h3>";
  echo "<div class='gridItemContent'>";

    //                  WTF is this????
    echo "Attendance rate: " . $participationRate['0']['Participation rate'] . "%<br/>";
    if(exists($winrate['0']['Winrate']))
    {
      echo "Winrate: " . $winrate['0']['Winrate'] . "%</br>";
    }
    else
    {
      echo "Winrate: NO WINS </br>";
    }

    if(exists($winrate['0']['Winrate']))
    {
      echo "Weighted Winrate: " . $winrateWeighted['0']['Winrate'] . "%</br>";
    }
    else
    {
      echo "Winrate: NO WINS </br>";
    }

    echo "<div class='pickedMovies'>";
    echo "Movies picked: ";
    if(exists($pickedMovies))
    {
      foreach($pickedMovies as $row)
      {
        echo $row['name'] . ", ";
      }
    }
    else
    {
      echo "NO WINS";
    }

    echo "</div>";
    echo "</div>";
  echo "</div>";
}

function PrintGenericStats($conn)
{

}

//används inte, maybe borde användas, idk
function exists($var)
{
  return (isset($var) && !empty($var));
}

function catchStatent(){
  echo '<h1>fuuuuuuuck</h1>';
}

?>