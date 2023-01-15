var movies = Array();
var sortOrder = 'ascending';

class Movie{
  constructor(id, name, genre, rating, jayornay, picker, participants, type)
  {
    this.id = id;
    this.name = name;
    this.genre = genre;
    this.rating = rating
    this.jayornay = jayornay;
    this.picker = picker;
    this.participants = participants;
    this.type = type;
  }
}

function CreateTable()
{
  var tableDiv = document.getElementById('tableContainer');
  tableDiv.style.textAlign = "center";
  var table = document.getElementById('movieTable');

  for (var i = 0; i < movies.length; i++)
  {
    var row = table.insertRow(1);
    row.classList.add('tableRow');

    cellID = row.insertCell(0);
    cellName = row.insertCell(1);
    cellGenre = row.insertCell(2);
    cellRating = row.insertCell(3);
    cellJayornay = row.insertCell(4);
    cellPicker = row.insertCell(5);
    cellParticipants = row.insertCell(6);
    cellType = row.insertCell(7);

    cellID.innerHTML = movies[i].id;
    cellName.innerHTML = movies[i].name;
    cellGenre.innerHTML = movies[i].genre;
    cellRating.innerHTML = movies[i].rating;
    cellJayornay.innerHTML = movies[i].jayornay;
    cellPicker.innerHTML = movies[i].picker;
    cellParticipants.innerHTML = movies[i].participants;
    if(movies[i].type == 0)
    {
      cellType.innerHTML = "Minor";  
    }
    else
    {
      cellType.innerHTML = "Major";
    } 

    cellID.classList.add('tableCell');
    cellName.classList.add('tableCell');
    cellGenre.classList.add('tableCell');
    cellJayornay.classList.add('tableCell');
    cellPicker.classList.add('tableCell');
    cellParticipants.classList.add('tableCell');
    cellType.classList.add('tableCell');
  }
  AddSortingListeners();
}

function AddSortingListeners()
{
  document.getElementById("sortID").addEventListener("click", function() 
  {
    SortTable(0);
  });
  document.getElementById("sortName").addEventListener("click", function() 
  {
    SortTable(1);
  });
  document.getElementById("sortGenre").addEventListener("click", function() 
  {
    SortTable(2);
  });
  document.getElementById("sortRating").addEventListener("click", function() 
  {
    SortTable(3);
  });
  document.getElementById("sortJayornay").addEventListener("click", function() 
  {
    SortTable(4);
  });
  document.getElementById("sortPicker").addEventListener("click", function() 
  {
    SortTable(5);
  });
  document.getElementById("sortParticipants").addEventListener("click", function() {
    SortTable(6);
  });
  document.getElementById("sortType").addEventListener("click", function() {
    SortTable(7);
  });
}

function SortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("movieTable");
  switching = true;
  // Set the sorting direction to ascending
  dir = "asc"; 
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (n === 0) {
          if (Number(x.innerHTML) > Number(y.innerHTML)) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      } else if (dir == "desc") {
        if (n === 0 || n === 3) {
          if (Number(x.innerHTML) < Number(y.innerHTML)) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function GetMovies()
{
  const params = new URLSearchParams();
  params.append('order', 'decending');

  console.log(`http://localhost/julet/api/movies.php?${params}`);
  
  fetch(`http://localhost/julet/api/movies.php?${params}`)
  .then(response => response.json())
  .then(data => 
  {
    results = data;
    for (var i = 0; i < results['data'].length; i++) 
    {
      var tempObject = JSON.parse(results['data'][i]);

      movies.push(new Movie(tempObject.id, tempObject.name, tempObject.genre, tempObject.rating, 
        tempObject.jayornay, tempObject.picker, tempObject.participants, tempObject.type));
    }
    CreateTable();
  });
}

function InsertMovie()
{
  const linkInput = document.getElementById("linkInput").value;
  const participantsInput = document.getElementById("participantsInput").value;
  const jayornayInput = document.getElementById("jayornayInput").value;
  const pickerInput = document.getElementById("pickerInput").value;
  const genreInput = document.getElementById("genreInput").value;
  const typeInput = document.getElementById("typeInput").value;

  if(linkInput !== "" && participantsInput !== "" && jayornayInput !== "" && pickerInput)
  {
    var results;
    var movies = new Array();
    const params = new URLSearchParams();

    params.append('link', linkInput);
    params.append('jayornay', jayornayInput);
    params.append('genre', genreInput);
    params.append('picker', pickerInput);
    params.append('participants', participantsInput);
    params.append('type', typeInput);

    fetch(`http://localhost/julet/api/movies.php`,
    {
      method: 'POST',
      body: params,
    })
    .then(response => response.json())
    .then(data => 
    {
      results = data;
      console.log(results);})
    .catch(error => {
      console.log(error);
    })
  }
  else
  {
    alert("Please fill in every field.");
  }
}

GetMovies();