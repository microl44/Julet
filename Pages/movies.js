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
  return movies;
}

async function RunAsync()
{
  const fuckshit = FetchMovies();
  await fuckshit;

  const holder = document.getElementById('moviePageWrapper');
  for (var i = 0; i < movies.length; i++)
  {
    try
    {
      const img_src = 'http://' + host + '/' + movies[i].cover_path.substring(movies[0].cover_path.indexOf("Shared"));
      var movieDisplayDiv = document.createElement('div');
        movieDisplayDiv.classList.add('movieDisplayDiv');

      var movieCoverHolder = document.createElement('div');
        movieCoverHolder.classList.add('movieCoverHolder');

      var image = document.createElement('img');
        image.src = img_src;
        image.setAttribute('width', '190');
        image.setAttribute('height', '281');
        image.setAttribute('onerror', "this.src='http://" + host + "/Shared/images/placeholder.png'");
      var movieTitleHolder = document.createElement('div');
        movieTitleHolder.classList.add('movieTitleHolder');

      var movieTitle = document.createElement('p');
        movieTitle.classList.add('movieTitle');
        movieTitle.innerText = movies[i].name;

      var movieDescription = document.createElement('p');
        movieDescription.innerText = movies[i].description;

      movieTitleHolder.appendChild(movieTitle);
      movieTitleHolder.appendChild(movieDescription);

      movieCoverHolder.appendChild(image);
      movieCoverHolder.appendChild(movieTitleHolder);

      movieDisplayDiv.appendChild(movieCoverHolder);

      holder.appendChild(movieDisplayDiv);
      //document.body.appendChild(test)
    }
    catch
    {
      console.log("fuck this shit")
    }
  }
}

RunAsync().catch(error =>
{
  console.log(error)
});

//document.body.appendChild(test);

//CreateMovieView();


/*
function PrintMovies()
{
    $imageDir = "../Shared/Images/";
    $images = SortArray(scandir($imageDir), "NATURAL");
    $conn = GetConn();

    $titles = $conn->query("SELECT `name`,`description` FROM movie ORDER BY id");

    foreach($images as $image)
    {
      if($image != '.' && $image != '..')
      {
        $title = $titles->fetch(PDO::FETCH_ASSOC);
        echo "<div class='movieDisplayDiv'>";
          echo "<div class='movieCoverHolder'>";
            echo "<img src='../Shared/Images/".$image."' alt='Girl in a jacket'> </img>";
            echo "<div class='movieTitleHolder'>";
              echo "<p class='movieTitle'><b>".$title['name']."</b></p>";
              echo "<p>".$title['description']."</p>";
            echo "</div>";
          echo "</div>"; 
        echo "</div>";
      }
    }
}
}*/