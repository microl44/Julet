<?php
  if(!isset($_SESSION))
  {
    session_start();
  }
  require_once "includers/basic.php";
  require_once "function.php";
  require_once "includers/header.php";


  if(isset($_SESSION['username']) || isset($_SESSION['password']))
  {
    addLog();
    $conn = GetConn();
    
    $stmt = $conn->query("SELECT name FROM participant ORDER BY name");
    $participants = $stmt->fetchAll();
    $stmt->closeCursor();

    $stmt = $conn->query("SELECT name FROM genre ORDER BY name");
    $genres = $stmt->fetchAll();
    $stmt->closeCursor();

    echo "<div class='quoteDiv' onload='hideOnScroll()'>";
      echo "<p class='quotequote'>".$quote['Quote']."</p>";
      echo "<p class='quoteauthor'>- ".$quote['Author']."</p>";
    echo "</div>";
    ?>
    <script>
      function temp(element)
      {
        window.open(element.getAttribute("data-value"), '_blank');
      }
    </script>
      <div class='content indexContent'>
        <!----------FILTER TABLE SECTION START---------->
        <div id=filterDiv>
          <h3> FILTER TABLE </h3>
          <!-- <img src='Shared/Icons/ChristmasSpirit.png' style='position: absolute;transform: scaleX(-1); z-index: 999; margin-left: -59%;px;margin-top: 150px;width: 50px; height: 50px'> -->
          <form action='index.php' method='POST'>
            <label for='input'>Search by winner: </label>
              <select class='filterLabel' name='searchByWinner'> 
                <option class='filterLabelOption'> SELECT </option>
                <?php 
                foreach($participants as $participant)
                {
                  echo "<option class='filterLabelOption'>" . $participant[0] . "</option>";
                }?>
              </select>
            <input class='filterSubmit' type='submit' value='Search'/>
          </form>

          <form action='index.php' method='POST'>
            <label for='searchParticipants'>Search by Participant: </label>
            <select class='filterLabel' name='searchParticipants'> 
              <option class='filterLabelOption'> SELECT </option>
              <?php 
              foreach($participants as $participant)
              {
                echo "<option class='filterLabelOption'>" . $participant[0] . "</option>";
              }?>
            </select>
            <input class='filterSubmit' type='submit' value='Search'/>
          </form>

          <form action='index.php' method='POST'>
            <label for='searchGenre'>Search by Genre: </label>
            <select style="text-align: left;" class='filterLabel' name='searchGenre'> 
              <option class='filterLabelOption'> SELECT </option>
              <?php 
              foreach($genres as $genre)
              {
                echo "<option class='filterLabelOption'>" . $genre[0] . "</option>";
              }?>
            </select>
            <input class='filterSubmit' type='submit' value='Search'/>
          </form>
            
          <form action='index.php' method='POST'>
            <label for='searchMovie'>Search by Movie Name: </label>
            <input class='jesusChrist' type='string' name='searchMovie'/>
            <input class='filterSubmit' type='submit' value='Search'/>
          </form>
        </div>
        <!----------FILTER TABLE SECTION END---------->

        <!----------DISPLAY TABLE SECTION START---------->
        <div id='tableContainer'>
        <?php
          if(isset($_POST['searchByWinner']))
          {
            $sql = "SELECT * FROM movie WHERE picked_by LIKE :input";
            $stmp = $conn->prepare($sql);
            $temp = "%" . $_POST['searchByWinner'] ."%";
            $stmp->bindvalue(":input",$temp);
            $result = $stmp->execute();
            PrintMovieTable($result,$stmp);
          }
          else if(isset($_POST['searchParticipants']))
          {
            $sql = "SELECT * FROM movie WHERE participants LIKE :input";
            $stmp = $conn->prepare($sql);
            $temp = "%" . $_POST['searchParticipants'] ."%";
            $stmp->bindvalue(":input",$temp);
            $result = $stmp->execute();
            PrintMovieTable($result,$stmp);
          }
          else if(isset($_POST['searchMovie']))
          {
            $sql = "SELECT * FROM movie WHERE name LIKE :input";
            $stmp = $conn->prepare($sql);
            $temp = "%" . $_POST['searchMovie'] ."%";
            $stmp->bindvalue(":input",$temp);
            $result = $stmp->execute();
            PrintMovieTable($result,$stmp);
          }
          else if(isset($_POST['searchGenre']))
          {
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
        ?>
        </div>
        <!----------DISPLAY TABLE SECTION END---------->
        
        <!----------INSERT NEW MOVIE FORM START---------->
        <h3>Add new movie </h3>
        <div class='addMovieDiv'>
            <form action='query.php' method='POST'>
              <div class='addMovieDivFirst'>
                <label for='addName'>IMDB Link: </label>
                <input id='addName' type='text' name='addName' required/><br/>

                <label for='addParticipants'> Participants: </label>
                <input type='text' name='addParticipants' required /> <br/>

                <label for='addjayornay'> Jay or Nay: </label>
                <input type='text' name='addjayornay' required /> <br/>
                </label>
              </div>

              <div class='addMovieDivSecond'>
                <label for='addPickedBy'> Picked By: </label>
                <select name='addPickedBy'> <?php 
                  foreach($participants as $participant)
                  {
                    echo "<option>" . $participant[0] . "</option>";
                  }?>
                </select> <br/>
                
                <label for='addGenre'> Genre: </label>
                <select name='addGenre'> <?php
                  foreach($genres as $genre)
                  {
                    echo "<option>" . $genre[0] . "</option>";
                  }?>
                </select> <br/>

                <label for='addIs_major'>WheelType </label>
                <select name='addIs_major' type='number'> <br/>
                  <option value='1'> Big Wheel </option>
                  <option value='0'> Small Wheel </option>
                </select> </br>

                <input id='addMovieBtn' type='submit' value='add movie'/>
              </div>
            </form>
        </div>
        <!----------INSERT NEW MOVIE FORM END---------->

        <!----------GENRE GRID BEGIN---------->
        <div id="gridBackgroundDiv">
          <h1> Genre Links </h1>
          <div class = "genreSection">
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-action" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=action&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> ACTION </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-adventure" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=adventure&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> ADVENTURE </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-animation" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=animation&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> ANIMATION </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-biography" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=biography&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> BIOGRAPHY </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-comedy" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=comedy&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> COMEDY </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-crime" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=crime&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> CRIME </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-drama" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=drama&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> DRAMA </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-family" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=family&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> FAMILY </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-fantasy" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=fantasy&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> FANTASY </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-history" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=history&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> HISTORY </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-horror" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=horror&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> HORROR </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-musical" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=musical&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> MUSICAL </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-mystery" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=mystery&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> MYSTERY </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-romance" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=romance&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> ROMANCE </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-sciencefiction" data-value="https://www.imdb.com/search/title/?genres=sci-fi&sort=num_votes,desc&explore=title_type,genres">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> SCIENCE-FICTION </p>
                </div>
              </div>
            </div>
          <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-sport" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=sport&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> SPORT </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-superhero" data-value="https://www.imdb.com/search/keyword/?keywords=superhero&sort=num_votes,desc&mode=detail&page=1&title_type=movie&ref_=kw_ref_typ">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> SUPERHERO </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-thriller" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=thriller&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> THRILLER </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-war" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=war&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> WAR </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-western" data-value="https://www.imdb.com/search/title/?title_type=feature&genres=western&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> WESTERN </p>
                </div>
              </div>
            </div>
            <div onclick="temp(this)" class = "genreDiv" id = "genreDiv-wildcard" data-value="https://www.imdb.com/search/title/?title_type=feature&sort=num_votes,desc&explore=genresgi">
              <div class = "imageFilter">
                <div class = "genreBubbleTextDiv">
                  <p class="genreHeader"> WILDCARD </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once "includers/footer.php"; 
      ?>
  <?php
  }
  else{
    notLoggedIn();
  }
?>
<script type="text/javascript" src="Javascript/functions.js"></script>
