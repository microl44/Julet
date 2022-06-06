<!DOCTYPE HTML>

<html>
    <link type="text/css" href="Shared/style.css" rel="stylesheet">
    <head>
        <div id ='nav-bar'>
          print_r("hellooooo");
        </div>
    </head>

<?php
include "includers/header.php";
include "Database.php";
$sql = "SELECT * FROM movie ORDER BY nr";

if ($result = $conn -> query($sql))
{
  echo "<input type='text' id='hejsan'> <button type='submit'>RUN QUERY</button></input>" ;

  echo "<br>";
  echo "<table border='1' style='font-weight: bold;'>";
    echo "<tr style='font-weight: italic;'>";
    echo "<td id='Hnr'>Nr</td>";
    echo "<td id='Hname'>Name</td>";
    echo "<td id='Hgenre_namn'>Genre</td>";
    echo "<td id='Hgrade'>IMDB Grade</td>";
    echo "<td id='Hjayornay'>Jay or Nay</td>";
    echo "<td id='Hpicked_by'>Picked By</td>";
    echo "<td id='Hparticipants'>Participants</td>";
    echo "<td id='His_major'>Wheel Type</td>";
    echo "</tr>";

  while ($row = mysqli_fetch_assoc($result)) 
  {
      echo "<tr>";
        echo "<td id='nr'>" . $row['nr'] . "</td>";
        echo "<td id='name'>" . $row['name'] . "</td>";
        echo "<td id='genre_namn'>" . $row['genre_name'] . "</td>";
        echo "<td id='imdbGrade'>" . $row['imdb_rating'] . "</td>";
        echo "<td id='jayornay'>" . $row['jayornay'] . "</td>";
        echo "<td id='picked_by'>" . $row['picked_by'] . "</td>";
	echo "<td id='participants'>" . $row['participants'] . "</td>";
	if($row['is_major'] == 1)
	{
		echo "<td id='is_major'>Major</td>";
	}
	else
	{
		echo "<td id='is_major'>Minor</td>";
	}
      echo "</tr>";
  }
  echo "</table>";
}
else{
echo "hello";
}
?>
