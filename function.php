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
    echo "Attendance rate: " . $participationRate['0']['Participation rate'] . "%";
    if(exists($winrate['0']['Winrate']))
    {
      echo "<p> Winrate: " . $winrate['0']['Winrate'] . "% </p>";
    }
    else
    {
      echo "<p> Winrate: NO WINS </br>";
    }

    if(exists($winrate['0']['Winrate']))
    {
      echo "<p> Weighted Winrate: " . $winrateWeighted['0']['Winrate'] . "% </p>";
    }
    else
    {
      echo "<p> Winrate: NO WINS  </p>";
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

function PrintMovies()
{
    $imageDir = 'C:/xampp/htdocs/Julet/Shared/Images/';
    $images = scandir($imageDir, SCANDIR_SORT_DESCENDING);

    $conn = GetConnection();
    $descriptions = $conn->query("SELECT description from movieDescription ORDER BY movieID;");

    foreach($images as $image)
    {
      if($image != '.' && $image != '..')
      {
        $description = $descriptions->fetch(PDO::FETCH_ASSOC);
        echo "<div class='movieDisplayDiv'>";
          echo "<div class='movieCoverHolder'>";
            echo "<img src='Shared/Images/".$image."' alt='Girl in a jacket'> </img>";
            echo "<div class='movieTitleHolder'>";
              echo "<p>".$description['description']."</p>";
            echo "</div>";
          echo "</div>"; 
        echo "</div>";
      }
    }
}

function exists($var)
{
  return (isset($var) && !empty($var));
}

function catchStatent(){
  echo '<h1>fuuuuuuuck</h1>';
}

// function to scrape cover art from IMDB page and save it as a .png on the server
function scrapeCoverArt($url, $savePath) {
   // create a variable to keep track of the number to append to the file name
  $count = 1;

  // create a variable to store the modified save path
  $modifiedSavePath = $savePath;

  // check if the file already exists
  while (file_exists($modifiedSavePath)) {
    // if the file exists, modify the save path to include the number
    $modifiedSavePath = preg_replace('/\.png$/', $count . '.png', $savePath);
    $count++;
  }

  // use cURL to send an HTTP request to the web page
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $html = curl_exec($ch);
  $error = curl_error($ch);
  curl_close($ch);

  if ($error) {
    echo "Error: " . $error;
    return;
  }

  // use DOMDocument to parse the HTML
  $dom = new DOMDocument();
  @$dom->loadHTML($html);

  // use DOMXPath to find the img tag with the class "ipc-image"
  $xpath = new DOMXPath($dom);
  $img = $xpath->query("//img[@srcset]")->item(0);
  if (!$img) {
    echo "Error: Could not find image tag";
    return;
  }

  // if the img tag was found, download the image file and save it as a .png on the server
  $imageUrl = $img->getAttribute('src');
  $imageData = file_get_contents($imageUrl);
  if (!$imageData) {
    echo "Error: Could not retrieve image data from " . $imageUrl;
    return;
  }
  if (!file_put_contents($modifiedSavePath, $imageData)) {
    echo "Error: Could not save image data to " . $modifiedSavePath;
    return;
  }
  return $count;
}

function tempSaveFile(){
  $weird = file_get_contents("C:/xampp/htdocs/Julet/Cat.png");

  file_put_contents("C:/xampp/htdocs/Julet/cover.png", $weird);
}
?>