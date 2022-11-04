<?php
include "includers/header.php";
include "Database.php";

$sql = "SELECT * FROM movie ORDER BY id";

if ($result = $conn -> query($sql))
{
  echo "<input type='hidden' id='hejsan'> <input type='hidden'></button></input>" ;

  echo "<br>";
  echo "<table>";
    echo "<tr class='TableRow'>";
    echo "<td class='TableName'>Nr</td>";
    echo "<td class='TableName'>Name</td>";
    echo "<td class='TableName'>Genre</td>";
    echo "<td class='TableName'>IMDB Grade</td>";
    echo "<td class='TableName'>Jay or Nay</td>";
    echo "<td class='TableName'>Picked By</td>";
    echo "<td class='TableName'>Participants</td>";
    echo "<td class='TableName'>Wheel Type</td>";
    echo "</tr>";

  while ($row = $result->fetch()) 
  {
      echo "<tr class='TableRow'>";
        echo "<td class='TableItem'>" . $row['id'] . "</td>";
        echo "<td class='TableItem'>" . $row['name'] . "</td>";
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
?>
