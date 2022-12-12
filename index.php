<!DOCTYPE html>
<?php
  require_once "loginFunctions.php";
  require_once "function.php";
  require_once "includers/header.php";

  if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    $conn = GetConnection();
    
    $stmt = $conn->query("SELECT name FROM participant ORDER BY name");
    $participants = $stmt->fetchAll();

    $stmt = $conn->query("SELECT name FROM genre ORDER BY name");
    $genres = $stmt->fetchAll();
    ?>
  
    <body>
      <div class='content'>
        <!----------FILTER TABLE SECTION START---------->
        <div id=filterDiv>
          <form action='index.php' method='POST'>
            <label for='input'>Search by winner: </label>
            <input type='string' name='searchByWinner'/>
            <input class='filterSubmit' type='submit' value='Search'/>
          </form>

          <div>
            <form action='index.php' method='POST'>
              <label for='searchParticipants'>Search by Participant: </label>
              <input type='string' name='searchParticipants'/>
              <input class='filterSubmit' type='submit' value='Search'/>
            </form>
          </div>

          <form action='index.php' method='POST'>
            <label for='searchGenre'>Search by Genre: </label>
            <input type='string' name='searchGenre'/>
            <input class='filterSubmit' type='submit' value='Search'/>
          </form>
            
          <form action='index.php' method='POST'>
            <label for='searchMovie'>Search by Movie Name: </label>
            <input type='string' name='searchMovie'/>
            <input class='filterSubmit' type='submit' value='Search'/>
          </form>
        </div>
        <!----------FILTER TABLE SECTION END---------->

        <!----------DISPLAY TABLE SECTION START---------->
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
      </div>
    </body>
  <?php
  }
  else{
    notLoggedIn();
  }
include "includers/footer.php";
?>
