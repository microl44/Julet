<?php
function PrintMovieTable($result,$stmp){
  if ($result){
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
        echo "<td style='border-left: 1px solid;' id='is_major'>Big Wheel</td>";
      }
      else
      {
        echo "<td style='border-left: 1px solid;' id='is_major'>Small Wheel</td>";
      }
      echo "<td class='tableItem'>";
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

//används inte, maybe borde användas, idk
function exists($var)
{
  if(isset($var) && !empty($var))
    {
      return true;
    }
    else
    {
      return false;
    }
}
?>