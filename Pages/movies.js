class Movie
{
  constructor(id, name, imdb_rating, description, cover_path)
  {
    this.id = id;
    this.name = name;
    this.imdb_rating = imdb_rating;
    this.description = description;
    this.cover_path = cover_path;
  }
}

var host = GetHost();
var movies = Array();
const url = 'http://localhost/shared/images/cover8.png'

async function FetchMovies()
{
  const params = new URLSearchParams();
  movies = []

  const res = await fetch(`http://${host}/api/movies.php?${params}`)
  const data = await res.json()

  for (var i = 0; i < data['data'].length; i++)
  {
    var temp = JSON.parse(data['data'][i]);
    movies.push(new Movie(temp.id, temp.name, temp.rating, temp.description, temp.cover_path));
  }
  //await PopulateTable('Marvel');
  return movies
}

CreateMovieView();

FetchMovies();
CreateMovieView();



/*
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
}*/