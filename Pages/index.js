class Movie
{
  constructor(id, name, genre, rating, jayornay, picker, participants, type, description, cover_path)
  {
    this.id = id;
    this.name = name;
    this.genre = genre;
    this.rating = rating
    this.jayornay = jayornay;
    this.picker = picker;
    this.participants = participants;
    this.type = type;
    this.description = description;
    this.cover_path = cover_path;
  }
}

class Participant
{
  constructor(id, name)
  {
    this.id = id;
    this.name = name;
  }
}

class Genre
{
  constructor(name)
  {
    this.name = name;
  }
}

var cookies = document.cookie;

var moviesGroup = Array();
var moviesMarvel = Array();
var moviesSolo = Array();
var participants = Array();
var genres = Array();
var isFetching = false;

function GetCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}


function ExpandRow(element)
{
  if(element.style.display == 'none')
  {
    element.style.display = 'block';
  }
  else
  {
    element.style.display = 'block';
  }
}

function CreateGroupTable()
{
  //console.log("CreateTable() Called.");
  const table = document.getElementById('groupMovie');
  for(var i = table.rows.length - 1; i >= 1; i--)
  {
    table.deleteRow(i);
  }

  //for each movie fetched, add new row with said movie info.
  for (var i = 0; i < moviesGroup.length; i++)
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

    cellID.innerHTML = moviesGroup[i].id;
    cellName.innerHTML = moviesGroup[i].name;
    cellGenre.innerHTML = moviesGroup[i].genre;
    cellRating.innerHTML = moviesGroup[i].rating;
    cellJayornay.innerHTML = moviesGroup[i].jayornay;
    cellPicker.innerHTML = moviesGroup[i].picker;
    cellParticipants.innerHTML = moviesGroup[i].participants;
    if(moviesGroup[i].type == 0)
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
}

function CreateMarvelTable()
{
  //console.log("CreateTable() Called.");
  const table = document.getElementById('marvelMovie');
  for(var i = table.rows.length - 1; i >= 1; i--)
  {
    table.deleteRow(i);
  }

  //for each movie fetched, add new row with said movie info.
  for (var i = 0; i < moviesMarvel.length; i++)
  {
    var row = table.insertRow(1);
    row.classList.add('tableRow');

    cellName = row.insertCell(0);
    cellRating = row.insertCell(1);
    cellParticipants = row.insertCell(2);

    cellName.innerHTML = moviesMarvel[i]['name'];
    cellRating.innerHTML = moviesMarvel[i].rating;
    cellParticipants.innerHTML = moviesMarvel[i].participants;

    cellName.classList.add('tableCell');
    cellRating.classList.add('tableCell');
    cellParticipants.classList.add('tableCell');
  }
}

function SortTable(n)
{
  //console.log("SortTable() Called.");
  var table;
  var rows;
  var switching;
  var i;
  var x;
  var y;
  var shouldSwitch;
  var dir;
  var switchCount = 0;

  table = document.getElementById("groupMovie");
  switching = true;
  dir = "asc";

  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) 
  {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) 
    {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") 
      {
        if (n === 0 || n === 3)
        {
          if (Number(x.innerHTML) > Number(y.innerHTML)) 
          {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } 
        else if (n === 6)
        {
          if(x.innerHTML.toLowerCase().match(/,/g).length > y.innerHTML.toLowerCase().match(/,/g).length)
          {
            shouldSwitch = true;
            break;
          }
        }
        else 
        {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
          {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      } 
      else if (dir == "desc") 
      {
        if (n === 0 || n === 3) 
        {
          if (Number(x.innerHTML) < Number(y.innerHTML)) 
          {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } 
        else if (n === 6)
        {
          if(x.innerHTML.toLowerCase().match(/,/g).length < y.innerHTML.toLowerCase().match(/,/g).length)
          {
            shouldSwitch = true;
            break;
          }
        }
        else 
        {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) 
          {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
    }
    if (shouldSwitch) 
    {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchCount ++;
    } 
    else
    {
      if(switchCount == 0 && dir == "asc")
      {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function PopulateAddNewMovieWinner()
{
  //console.log("PopulateAddNewMovieWinner() Called."); 
  const winnerDropdown = document.getElementById('pickerInput');
  const SELECT = document.createElement("option");
  SELECT.text = "SELECT";
  winnerDropdown.append(SELECT);

  for(var i = 0; i < participants.length; i++)
  {
    const pickerDropdownOption = document.createElement("option");
    pickerDropdownOption.text = participants[i].name;
    winnerDropdown.append(pickerDropdownOption);
  }
}

function PopulateAddNewMovieGenre()
{
  //console.log("PopulateAddNewMovieGenre() Called.");
  const genreDropdown = document.getElementById('genreInput');
  const SELECT = document.createElement("option");
  SELECT.text = "SELECT";
  genreDropdown.append(SELECT);

  for(var i = 0; i < genres.length; i++)
  {
    const dropdownEntry = document.createElement("option");
    dropdownEntry.text = genres[i].name;
    genreDropdown.append(dropdownEntry);
  }
}

function PopulateGenreFilter()
{
  //console.log("PopulateGenreFilter() Called."); 
  const filterGenre = document.getElementById('filterGenre');
  const SELECT = document.createElement("option");
  SELECT.text = "SELECT";
  filterGenre.append(SELECT);

  for(var i = 0; i < genres.length; i++)
  {
    const dropdownEntry = document.createElement("option");
    dropdownEntry.text = genres[i].name;
    filterGenre.append(dropdownEntry);
  }
}

function PopulateParticipantFilter()
{
  //console.log("PopulateParticipantFilter() Called."); 
  const participantsDropdown = document.getElementById('filterParticipant');
  const winnerDropdown = document.getElementById('filterPicker');
  const SELECT = document.createElement("option");
  const SELECT2 = document.createElement("option");
  SELECT.text = "SELECT";
  SELECT2.text = "SELECT";
  participantsDropdown.append(SELECT);
  winnerDropdown.append(SELECT2);

  for(var i = 0; i < participants.length; i++)
  {
    const dropdownEntry = document.createElement("option");
    const dropdownEntry2 = document.createElement("option");
    dropdownEntry.text = participants[i].name;
    dropdownEntry2.text = participants[i].name;
    participantsDropdown.append(dropdownEntry);
    winnerDropdown.append(dropdownEntry2);
  }
}

function CreateSortPanel()
{   
  //console.log("CreateSortPanel() Called.");
 
  const filterName = document.getElementById('filterName');

  const filterPicker = document.getElementById('filterPicker');
    const filterPickerTop = document.createElement("option");
    filterPickerTop.text = "SELECT";
    filterPicker.append(filterPickerTop);

  const filterParticipant = document.getElementById('filterParticipant');
    const filterParticipantTop = document.createElement("option");
    filterParticipantTop.text = "SELECT";
    filterParticipant.append(filterParticipantTop)

  const filterRating = document.getElementById('filterRating');

  for(var i = 0; i < participants.length; i++)
  {
    const filterPickerOption = document.createElement("option");
    const filterParticipantOption = document.createElement("option");

    filterParticipantOption.value = participants[i].name;
    filterParticipantOption.text = participants[i].name;

    filterPickerOption.value = participants[i].name;
    filterPickerOption.text = participants[i].name;

    filterParticipant.append(filterParticipantOption);      
    filterPicker.append(filterPickerOption);
  }

  const applyBtn = document.getElementById('filterApply');
  applyBtn.removeEventListener("click", ApplyEvent);
  applyBtn.addEventListener("click", function()
  {
    ApplyEvent(filterName, filterPicker, filterParticipant)
  });

  const resetBtn = document.getElementById('filterReset');
  resetBtn.removeEventListener("click", ResetEvent);
  resetBtn.addEventListener("click", function(){ResetEvent(filterName, filterPicker, filterParticipant)}, {once: true});

  filterName.addEventListener("keypress", function(e)
  {
    if(e.key === 'Enter')
    {
      console.log("Apply button clicked");
      applyBtn.click();
    }
  });
}

function ApplyEvent()
{
  //console.log("button clicked");
  var name;
  var genre;
  var rating;
  var jayornay;
  var picker;
  var participant;
  var type;

  //if X field doesn't contain the default value (empty), send it as an argument to the fetch api.
  if(filterName.value != "")
    {name = filterName.value;}
  if(filterPicker.options[filterPicker.selectedIndex].value !== "SELECT")
    {picker = filterPicker.options[filterPicker.selectedIndex].value;}
  if(filterParticipant.options[filterParticipant.selectedIndex].value !== "SELECT")
    {participant = filterParticipant.options[filterParticipant.selectedIndex].value;}
  if(filterGenre.options[filterGenre.selectedIndex].value !== "SELECT")
    {genre = filterGenre.options[filterGenre.selectedIndex].value;}
  if(filterRating.options[filterRating.selectedIndex].value !== "SELECT")
    {rating = filterRating.options[filterRating.selectedIndex].value;}

  GetMovies(name, genre, rating, jayornay, picker, participant, type);
}

function ResetEvent()
{
  //console.log("resetBtn clicked");
  filterPicker.selectedIndex = 0;
  filterParticipant.selectedIndex = 0;
  filterGenre.selectedIndex = 0;
  filterRating.selectedIndex = 0;
  filterName.value = "";

  GetMovies();
}

function openTable(evt, tableName)
{
  var jesus, tableList;

  tableList = document.getElementsByClassName("movieTable");
  for (jesus = 0; jesus < tableList.length; jesus++)
  {
    tableList[jesus].style.display = "none";
  }

  visibleTable = document.getElementById(tableName);
  visibleTable.style.display = "table";
  visibleTable.style.textAlign = "left";
}

function GetParticipants(name = null)
{
  //console.log("GetParticipants() Called.");
  participants = [];
  params = new URLSearchParams();

  if(name != null)
    {params.append('name', name);}

  fetch(`http://94.254.3.216/api/participants.php?${params}`)
  .then(response => response.json())
  .then(data =>
  {
    results = data;

    for (var i = 0; i < results['data'].length; i++)
    {
      var tempObject = JSON.parse(results['data'][i]);
      participants.push(new Participant(tempObject.id, tempObject.name));

      //CreateSortPanel();

      //const addMoviePicker = document.getElementById('pickerInput');
      //const addMoviePickerOption = document.createElement("option");
      //addMoviePickerOption.text = tempObject.name;
      //addMoviePicker.append(addMoviePickerOption);
    }
    PopulateParticipantFilter();
    PopulateAddNewMovieWinner();
  })
}


function GetGenres(name = null)
{
  //console.log("GetGenres() Called.");
  genres = [];
  params = new URLSearchParams();

  if(name != null)
    {params.append('name', name);}

  fetch(`http://94.254.3.216/api/genres.php?${params}`)
  .then(response => response.json())
  .then(data =>
  {
    results = data;

    for (var i = 0; i < results['data'].length; i++)
    {
      var tempObject = JSON.parse(results['data'][i]);
      genres.push(new Genre(tempObject.name));

      //const addMovieGenre = document.getElementById('genreInput');
      //const addMovieGenreOption = document.createElement("option");
      //addMovieGenreOption.text = tempObject.name;
      //addMovieGenre.append(addMovieGenreOption);
    }
    PopulateGenreFilter();
    PopulateAddNewMovieGenre();
  })
}

function CreateLoadingRow()
{
  //const table = document.getElementById('movieTable');
  //loadingDiv = document.createElement('TR');
  //loadingDiv.classList.add("APIcallLoadingRow");
  //loadingDiv.innerHTML = "LOADING";
  //table.append(loadingDiv);
}

function GetMovies(name = null,  genre = null, rating = null, jayornay = null, picker = null, participant = null, type = null)
{
  //CreateLoadingRow();

  moviesGroup = [];
  const params = new URLSearchParams();
  if(name != null)
    {params.append('name', name);}
  if(genre != null)
    {params.append('genre', genre);}
  if(rating != null)
    {params.append('rating', rating);}
  if(jayornay != null)
    {params.append('jayornay', jayornay);}
  if(picker != null)
    {params.append('picker', picker);}
  if(participant != null)
    {params.append('participant', participant);}
  if(type != null)
    {params.append('type', type);}

  params.append('order', 'decending');

  if(GetCookie('username'))
  {params.append('username', GetCookie('username'));}

  console.log(params.toString());
  if(isFetching)
  {
    return;
  }

  isFetching = true;

  try
  {
    fetch(`http://94.254.3.216/api/movies.php?${params}`)
    .then(response => response.json())
    .then(data => 
    {
      results = data;
      for (var i = 0; i < results['data']['group'].length; i++)
      {
        var tempObject = JSON.parse(results['data']['group'][i]);

        moviesGroup.push(new Movie(tempObject.id, tempObject.name, tempObject.genre, tempObject.rating, 
          tempObject.jayornay, tempObject.picker, tempObject.participants, tempObject.type, tempObject.description, tempObject.cover_path));
      }

      for (var i = 0; i < results['data']['marvel'].length; i++)
      {
        var tempObject = JSON.parse(results['data']['marvel'][i]);

        moviesMarvel.push(new Movie(null ,tempObject.name, null, tempObject.rating, null, null, tempObject.participants));
      }
      CreateGroupTable();
      CreateMarvelTable();
      isFetching = false;
    })
  }
  catch(error)
  {
    fetch(`http://127.0.0.1/api/movies.php?${params}`)
    .then(response => response.json())
    .then(data =>
    {
      results = data;
      for (var i = 0; i < results['data']['group'].length; i++)
      {
        var tempObject = JSON.parse(results['data'][i]);

        moviesGroup.push(new Movie(tempObject.id, tempObject.name, tempObject.genre, tempObject.rating, 
          tempObject.jayornay, tempObject.picker, tempObject.participants, tempObject.type, tempObject.description, tempObject.cover_path));
      }   
      CreateTable();
      isFetching = false;   
    })
  }
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

    console.log("sending movie:");
    console.log(linkInput);
    console.log(participantsInput);
    console.log(jayornayInput);
    console.log(pickerInput);
    console.log(genreInput);
    console.log(typeInput);

    params.append('link', linkInput);
    params.append('jayornay', jayornayInput);
    params.append('genre', genreInput);
    params.append('picker', pickerInput);
    params.append('participants', participantsInput);
    params.append('type', typeInput);

    fetch(`http://94.254.3.216/api/movies.php`,
    {
      method: 'POST',
      body: params,
    })
    .then(response => response.json())
    .then(data => 
    {
      results = data;
      console.log(results);})
    .catch(error => 
    {
      console.log(error);
    });
  }
  else
  {
    alert("Please fill in every field.");
  }
}
GetMovies();
GetParticipants();
GetGenres();
//CreateSortPanel();