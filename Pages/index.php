<?php
  if(!isset($_SESSION))
  {
    session_start();
  }
  require_once "../includers/basic.php";
  require_once "../function.php";
  require_once "../includers/header.php";

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
        <div id=filterDivHolder>
        <!----------FILTER TABLE SECTION START---------->
          <div id=filterDiv>

            <div class='filterInputDiv'>
              <label class='filterInputDivLabel' for='filterName'>Filter by movie name:</label>
              <input class='filterInputDivInput' id='filterName'> </input>
            </div>

            <div class='filterInputDiv'>
              <label class='filterInputDivLabel' for='filterPicker'>Filter by winner:</label>
              <select class='filterInputDivInput' id='filterPicker'></select>
            </div>

            <div class='filterInputDiv'>
              <label class='filterInputDivLabel' for='filterParticipant'>Filter by participant:</label>
              <select class='filterInputDivInput' id='filterParticipant'></select>
            </div>

            <div class='filterInputDiv'>
              <label class='filterInputDivLabel' for='filterGenre'>Filter by Genre:</label>
              <select class='filterInputDivInput' id='filterGenre'></select>
            </div>

            <div class='filterInputDiv'>
              <label class='filterInputDivLabel' for='filterRating'>Filter by rating:</label>
              <select class='filterInputDivInput' id='filterRating'>
                <option value="SELECT">SELECT</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>

            <div id='filterButtons'>
              <button id='filterApply' onclick='ApplyEvent()'>Apply</button>
              <button id='filterReset' onclick='ResetEvent()'>Reset</button>
            </div>
          </div>
        </div>
        <!----------FILTER TABLE SECTION END---------->

        <!----------DISPLAY TABLE SECTION START---------->
        <div id='tableContainer'>
          <table id='movieTable' cellspacing="0">
            <tr class='tableHeader'>
              <td class='tableHeaderTD' id='sortID', onclick='SortTable(0)'>ID</td>
              <td class='tableHeaderTD' id='sortName', onclick='SortTable(1)'>NAME</td>
              <td class='tableHeaderTD' id='sortGenre', onclick='SortTable(2)'>GENRE</td>
              <td class='tableHeaderTD' id='sortRating', onclick='SortTable(3)'>RATING</td>
              <td class='tableHeaderTD' id='sortJayornay', onclick='SortTable(4)'>JAY OR NAY</td>
              <td class='tableHeaderTD' id='sortPicker', onclick='SortTable(5)'>PICKER</td>
              <td class='tableHeaderTD' id='sortParticipants', onclick='SortTable(6)'>PARTICIPANTS</td>
              <td class='tableHeaderTD' id='sortType', onclick='SortTable(7)'>TYPE</td>
            </tr>
          </table>
        </div>
        <!----------DISPLAY TABLE SECTION END---------->
        
        <?php
        if(isset($_SESSION['username']) || isset($_SESSION['password']))
        {
          echo "<!----------INSERT NEW MOVIE FORM START---------->
          <h3>Add new movie </h3>
          <div class='addMovieDiv'>
                <div class='addMovieDivFirst'>
                  <label for='linkInput'>IMDB Link: </label>
                  <input id='linkInput' type='text' name='addName' required/><br/>

                  <label for='participantsInput'> Participants: </label>
                  <input id='participantsInput' type='text' name='addParticipants' required /> <br/>

                  <label for='jayornayInput'> Jay or Nay: </label>
                  <input id='jayornayInput' type='text' name='addjayornay' required /> <br/>
                  </label>
                </div>

                <div class='addMovieDivSecond'>
                  <label for='pickerInput'> Picked By: </label>
                  <select id='pickerInput' name='addPickedBy'>
                  </select> <br/>
                  
                  <label for='genreInput'> Genre: </label>
                  <select id='genreInput' name='addGenre'>
                  </select> <br/>

                  <label for='typeInput'>WheelType </label>
                  <select id='typeInput' name='addIs_major' type='number'> <br/>
                    <option value='1'> Big Wheel </option>
                    <option value='0'> Small Wheel </option>
                  </select> </br>

                  <input id='addMovieBtn' type='submit' onclick='InsertMovie()'' value='add movie'/>
                </div>
          </div>
          <!----------INSERT NEW MOVIE FORM END---------->";
        }?>

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
        <!--------GENRE SECTION ENDS--------->
      </div>
      <?php include_once "../includers/footer.php"; 
      ?>
  <?php
?>
<script type="text/javascript" src="index.js"></script>