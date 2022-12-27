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
  $quotes = array("Nu är det hjul igen, o nu är det hjul igen, o hjulen varar fram till kl elva", "Antman 2 är hot garbage", "Any similarities to real holidays is purely coincidental.", 
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
  "Bugs are to be expected. On finding any bug-free functionality, please immediately contact an admin for correction.", "All bugs are welcome. Except spiders, but only because they're arachnoids and not bugs.", "Please only use SQL injections for good purposes", "Fucking magnets, how do they work?", "Battle not with monsters, lest ye become a monster, and if you gaze into JavaScript, the JavaScript gazes also into you", "I write HTML, therefore I ain't", "Why use margin when <\br><\br><\br><\br><\br><\br><\br><\br><\br><\br><\br> do trick?",
  "Borderlands 3 session, when?", "If only I had a website that could depict movie stats and 100 random quotes at the same time...", 
  "See, marvel movies are like Onions. Each layer... Wait, why's there only 1 layer?", "We sped up the natural cycle of life and death! We gave these two suckers a shortcut!",
  "Fuck that 8 year old, she's a fucking bitch", "AI written code sounds cool, until you realize it's responsible for breaking this website every week", "DNA is just compiled protein-code",
  "Don't mind your PC lifting, it's just the bitcoin-miner doing what it's supposed to.", "The wheel giveth, the wheel taketh. However, for some it seems it's mostly taketh",
  "Please donate to my patreon. Together we can fund enough money and buy the right to Ant Man 2 so no one has to see it again", 
  "Lord of the rings is dumb, they could've just taken the eagles to mordor", "There's always another after-credits scene", 
  "Looking for front-end develops capable of center a div. Please send an email if this applies to you", "The syntax is more what you'd call guidelines than actual rules",
  "I got a <s>jar</s> repo of dirt, I got a <s>jar</s> repo of dir!", "Did you know that evehaup916adskasyjk BELLA NER FRÅN TANGENTBORDET! HDSFJJ",
  "So long, and thanks for all the fish!", "Hörru, du har inte tid att kolla på film, du har skolarbete att göra.", "We didn't invent the wheel, we just perfected it",
  "That Dicaprio guy is pretty good but I don't know if he's good enough for an oscar", "A list of a thousand movies begins with a single spin",
  "the rumors of my death have been greatly exaggerated", "WHEEEEEELSON!!!", 
  "Don't judge each other by the actions they take, instead judge each other by their Jul-winrates. Get fucked Linus.",
  "Don't use a wheel to determine what's for dinner", "The greatest glory lies not in never failing, but to see shawshank redemtion lose to the bee movie.",
  "Do you feel lucky, punk?", "You might not have won, but you've instead learned a valuable lesson in losing with grace.", 
  "Holy shit, what an amazing website! Fuck it this is mine now", "Any web-scraping you find is approved by imdb. No need to contact them about it, I swear",
  "There's good movies within every category. Yes, even Sports", "You miss 100% of the movies you don't bring to the wheel", 
  "Only three things are certain in life: death, taxes and the fact that antman movies will throw in quantum physics for no reason",
  "We might watch together, but we will always spin alone", "I pity the fool that hasn't won yet!", "Cult is an ugly word, I preffer 'up-and-coming religion'",
  "Guess you could call Tarantino movies a 'cult-classic' around here", "I'd rather shit myself than join the army", "Brooks was here", "Arcane is NOT an anime", 
  "Mr Behrad, I don't feel so good", "Hey, did the toys in that kids movie just embrace death?", "You have your mothers <s>eyes</s> shit taste in movies", "Now with working hash functions",
  "Please keep any tears away from the wheel", "Say 'Hello' to my little wheel!", "I love the smell of napalm in the morning", "We're gonna need a bigger wheel",
  "Any desired feature suggestions should be translated into monkey-speak and sent to CodeMonkeyBehrad@gmail.com", "The needs of the wheel outweighs the needs of the many");

  $quotees = array("Abraham Lincoln", "Winston Churchill", "Martin Luther King (jr)", "Santa", "Behrad", "Tony Stark", "Linus", "Malcolm X", "He who never wins", "Michael Bay",
  "Micke", "Gabbe", "Crippe", "Momme", "Julius Caesar", "Disney", "Captain Glock", "Thor", "Spider-Man", "Stephen Hawking", "Margaret Thatcher", "George Washington", "Thanos", 
  "Friedrich Nietzsche", "Marvel Hater", "Ghandi", "Nelson Mandela", "Babe Ruth", "Albert Einstein", "George Michael", "Clint Eastwood", "Bob Marley", "Barack Obama", 
  "Franklin D Roosevelt", "Henry Ford", "Priest of the Wheel", "Professor Dumbeldore");

  $randomQuote = $quotes[rand(0, count($quotes)-1)];
  $randomQuotee = $quotees[rand(0, count($quotees)-1)];
  #$randomQuote = "You have your mothers <s>eyes</s> shit taste in movies";
  #$randomQuote = count($quotes);
  #$randomQuotee = count($quotees);
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
  else if($randomQuote == "Fuck that 8 year old, she's a fucking bitch")
  {
    $randomQuotee = "Bunch of grown-ass-men watching kids nation";
  }
  else if($randomQuote == "The syntax is more like guidelanes rather than actual rules")
  {
    $randomQuotee = "HTML & PHP";
  }
  else if($randomQuote == "I got a jar of dirt, I got a jar of dir!")
  {
    $randomQuotee = "The people working on this website";
  }
  else if($randomQuote == "the rumors of my death have been greatly exaggerated")
  {
    $randomQuotee = "Nelson Mandela";
  }
  else if($randomQuote == "WHEEEEEELSON!!!")
  {
    $randomQuotee = "Tom Hanks";
  }
  else if($randomQuote == "Holy shit, what an amazing website! Fuck it this is mine now")
  {
    $randomQuotee = "Thomas Edison";
  }
  else if($randomQuote == "I pity the fool that hasn't won yet!")
  {
    $randomQuotee = "Mr T";
  }
  else if($randomQuote == "Guess you could call Tarantino movies a 'cult-classic' around here")
  {
    $randomQuotee = "Priest of the Wheel";
  }
  else if($randomQuote == "I'd rather shit myself than join the army")
  {
    $randomQuotee = "Ted Nugent";
  }
  else if($randomQuote == "Brooks was here")
  {
    $randomQuotee = "Micke, efter 4 timmar av PDO error debugging";
  }
  else if($randomQuote == "Mr Behrad, I don't feel so good")
  {
    $randomQuotee = "install.php";
  }
  else if($randomQuote == "I love the smell of napalm in the morning")
  {
    $randomQuotee = "Linus, arriving at the server room";
  }
  $quote['Quote'] = $randomQuote;
  $quote['Author'] = $randomQuotee;
  return $quote;
}
?>