<?php
  if(!isset($_SESSION))
  {
    session_start();
  }
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
      echo "<td class='TableItem TableHeader'>Delete Record</td>";
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
    $images = scandir($imageDir);
    natsort($images);
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

function giveRandomQuote(){
  $quotes = array("Nu är det hjul igen, nu är det hjul igen, hjulen varar fram till kl 23.00", "Antman 2 är hot garbage", "Any similarities to real holidays is purely coincidental.", 
  "The better jul", "Seeing the 4th movie first should be illegal", "I have a dream, that a movie shall not be judged by the image on the cover, but by the content of the story!",
  "Höhöhö sån färg borde man ha", "Linus vinner alltid", "Linus vinner aldrig", "I created Ultron, and I'd do it again!", "It's the ballot or the wheel!", 
  "The greatest trick the devil played was making humans believe the wheel wasn't rigged", "The wheel is probably not rigged. Probably...",
  "It is during our darkest moments that we must focus to see the light", "Thanos should've won", "Yeah Spider-Man was great and all but have you seen Black Widow?",
  "Om en funktion saknas så var det helt enkelt en fråga om prioriteringar", "Do you think god stays in heaven because he too lives in fear of what he's created?", "It's like printing my own money!",
  "i volunteer as tribute!", "Screaming goats are fucking hillarious!", "The council will decide on your fate", "I hearby sentence you to eternal damnation!", 
  "Gentlemen, it's with great pleasure to imform you that I just won the wheel", "Allt är Henriks fel!", "REEEEEEEEEEEEEEEEEEEEEE", "Gabbe köp en riktig stol för fan!",
  "Where is the server goblin when you need him?", "Bro It's like gambling but I literally can't lose!", "Du är för dålig för att snurra hjul",
  "Ant-Man could've easily defated Thanos if he just jumped int-", "Because that's what heroes do", "do you know how much I've sacrificed!?",
  "Fun Isn’t Something One Considers When programming in JavaScript. But This… Does Put A Smile On My Face.", "I'm a survivor", "Asså, vi har ett alvarligt problem!", 
  "Eyy Behrad, kör DS3 DLC istället för att sitta här", "I think I'm gonna die out here", 
  "Due to budget cuts we must band together, as a family, and reallocate all profits to my bank account", "Imagine att spendera 180kr för att se Ant-Man 2 på bio HÖHÖHÖ", 
  "A constant? Of course it is, I haven't touched it yet","BRUH", "Hjulen på bussen de går runt runt runt, runt runt run-Ahmen vafan, Linus! Det är något fel på hjulet!",
  "Please don't touch anything. Code displayed is fragile and will disintegrate on touch.", 
  "Bugs are to be expected. On finding any bug-free functionality, please immediately contact an admin for correction.", "All bugs are welcome. Except spiders, but only because they're arachnoids and not bugs.", "Please only use SQL injections for good purposes", "Fucking magnets, how do they work?", "Battle not with monsters, lest ye become a monster, and if you gaze into JavaScript, the JavaScript gazes also into you", "I write HTML, therefore I ain't", "Why use margin when <\br><\br><\br><\br><\br><\br><\br><\br><\br><\br><\br> do trick?", "");
  
  $quotees = array("Abraham Lincoln", "Winston Churchill", "Martin Luther King (jr)", "Santa", "Behrad", "Tony Stark", "Linus", "Malcolm X", "He who never wins", "Michael Bay",
  "Micke", "Gabbe", "Crippe", "Momme", "Julius Caesar", "Disney", "Captain Glock", "Thor", "Spider-Man", "Stephen Hawking", "Margaret Thatcher", "George Washington", "Thanos", 
  "Friedrich Nietzsche", );

  $randomQuote = $quotes[rand(0, count($quotes)-1)];
  $randomQuotee = $quotees[rand(0, count($quotees)-1)];
  $randomQuote = "Why use margin when <\br><\br><\br><\br><\br><\br><\br><\br><\br><\br><\br> do trick?";
  if($randomQuote == "It is during our darkest moments that we must focus to see the light")
  {
    $randomQuotee = "Guy who never won";
  }
  else if($randomQuote == "Do you think god stays in heaven because he too lives in fear of what he's created?")
  {
    $randomQuotee = "Behrad, när någon pillrar på install.php";
  } 
  else if($randomQuote == "It's like printing my own money!")
  {
    $randomQuotee = "Disney";
  }
  else if($randomQuote == "i volunteer as tribute!")
  {
    $randomQuotee = "Black Widow";
  }
  else if($randomQuote == "I hearby sentence you to eternal damnation!")
  {
    $randomQuotee = "Julrådet straffar Momme (colorized) (2022)";
  }
  else if($randomQuote == "Bro It's like gambling but I literally can't lose!")
  {
    $randomQuotee = "Linus, när han köper boosters";
  }
  else if($randomQuote == "Du är för dålig för att snurra hjul")
  {
    $randomQuotee = "Micke, till alla andra";
  }
  else if($randomQuote == "do you know how much I've sacrificed!?")
  {
    $randomQuotee = "Pol Pot";
  }
  else if($randomQuote == "I'm a survivor")
  {
    $randomQuotee = "Micke & Linus efter projektet";
  }
  else if($randomQuote == "Asså, vi har ett alvarligt problem!")
  {
    $randomQuotee = "Mats & Denna sida";
  }
  else if($randomQuote == "A constant? Of course it is, I haven't touched it yet")
  {
    $randomQuotee = "Python";
  }
  $quote['Quote'] = $randomQuote;
  $quote['Author'] = $randomQuotee;
  return $quote;
}
?>