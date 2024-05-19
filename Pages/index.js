//#################################################################
//#################CLASSES DECLARATION BEGIN#######################
//#################################################################

class Solo_movie
{
  constructor(id, participant_id, participant, user_rating, imdb_rating, movie, movie_id, description, cover_path)
  {
    this.id = id;
    this.participant_id = participant_id;
    this.participant = participant;
    this.user_rating = user_rating;
    this.imdb_rating = imdb_rating;
    this.movie = movie;
    this.movie_id = movie_id;
    this.description = description;
    this.cover_path = cover_path;
  }
}

class Group_movie
{
  constructor(id, participant_id, participant, genre, picked_by, movie, imdb_rating, description, jayornay, is_mayor, cover_path)
  {
    this.id = id;
    this.participant_id = participant_id;
    this.participant = participant;
    this.genre = genre;
    this.picked_by = picked_by;
    this.movie = movie;
    this.imdb_rating = imdb_rating;
    this.description = description;
    this.jayornay = jayornay;
    this.is_mayor = is_mayor;
    this.cover_path = cover_path;
  }
}

class Marvel_movie
{
  constructor(id, participant_id, participant, user_rating, imdb_rating, movie, movie_id, description, cover_path)
  {
    this.id = id;
    this.participant_id = participant_id;
    this.participant = participant;
    this.user_rating = user_rating;
    this.imdb_rating = imdb_rating;
    this.movie = movie;
    this.movie_id = movie_id;
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

//#################################################################
//#################CLASSES DECLARATION END#########################
//#################################################################



//#################################################################
//#################VARIABLE DECLARATION BEGIN######################
//#################################################################

const TableType = Object.freeze(
{
	Group: 'Group',
	Solo: 'Solo',
	Marvel: 'Marvel'
});

//get host from basic.js
var host = GetHost();
var cookies = document.cookie;

//arrays for fetched data
var groupMovies = Array();
var marvelMovies = Array();
var soloMovies = Array();
var participants = Array();
var genres = Array();
var group_section_index = 0;
var marvel_section_index = 0;
var solo_section_index = 0;
var section_mult = 10;

//used to prevent multipe fetch requests at same time
var isFetching = false;

//#################################################################
//#################VARIABLE DECLARATION END########################
//#################################################################


//extract from cookie. Weird bug causes information to be forgotten after a while of not reloading page.
function GetCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}

function GetActiveTable()
{
  const array = ['groupMovie', 'soloMovie', 'marvelMovie'];
  const names = ['Group', 'Solo', 'Marvel']
  array.forEach(function (item, index)
  {
    if (document.getElementById(item).style.display != 'none')
    {
      return document.getElementById(item);
    }
  });
}

function GetActiveTableName()
{
  const array = ['groupMovie', 'soloMovie', 'marvelMovie'];
  const names = ['Group', 'Solo', 'Marvel']
  array.forEach(function (item, index)
  {
    if (document.getElementById(item).style.display != 'none')
    {
      switch(item)
      {
      case 'groupMovie':
        return 'Group';
        break;
      case 'soloMovie':
        return 'Solo';
        break;
      case 'marvelMovie':
        return 'Marvel';
        break;
      default:
        return "NO TABLE OF SAID TYPE IS ACTIVE.";
        break;
      }
      return names[index]
    }
  })
}

//Expands table entry row. Work to do: 1. Push down rest of table. 2. Display cover image. 3. Display description 
function ExpandRow(element)
{
  if(element.style.display == 'none')
  {
    element.style.display = 'block';
  }
  else
  {
    element.style.display = 'none';
  }
}

//Cleans table 
function CleanTable(TableType)
{
	var table;
	switch (TableType)
	{
		case 'Group':
			table = document.getElementById('groupMovie');
			break;
		case 'Solo':
			table = document.getElementById('soloMovie');
			break;
		case 'Marvel':
			table = document.getElementById('marvelMovie');
			break;
		default:
			console.log("Error: argtype error, wrong tabletype passed.")
			break;
	}
	for(var i = table.rows.length - 1; i >= 1; i--)
	{
		table.deleteRow(i);
	}
	return table;
}

function PopulateTable(type)
{
  switch(type){
  case 'Group':
    CreateGroupTable();
    break;
  case 'Solo':
    CreateSoloTable();
    break;
  case 'Marvel':
    CreateMarvelTable();
    break;
  default:
    break;
  }
}

function AddTablePageDiv(TableType)
{
	const table = document.getElementById(TableType);

	var div = document.CreateElement()
}

function ChangePage(rightleft)
{
  switch(GetActiveTableName())
  {
  case 'Group':
    if (rightleft == "right"){group_section_index = group_section_index + 1;}
    else if(group_section_index > 0){group_section_index = group_section_index - 1;}
    PopulateTable("Group")
    break;
  case 'Solo':
    if (rightleft == "right"){solo_section_index = solo_section_index + 1;}
    else if(solo_section_index > 0){solo_section_index = solo_section_index - 1;}
    PopulateTable("Solo")
    break;
  case 'Marvel':
    if (rightleft == "right"){marvel_section_index = marvel_section_index + 1;}
    else if(marvel_section_index > 0){marvel_section_index = marvel_section_index - 1;}
    PopulateTable("Marvel")
    break;
  }
}

function CleanGroupArray()
{
  var tempMovieList = [];

  for (var i = groupMovies.length - 1; i >= 0; i--)
  {
    if (i < 0)
    {
      break;
    }
    if (i == 0)
    {
      concattedString += participants[parseInt(groupMovies[i].participant_id) - 1].name + " ";
      continue;
    }

    try
    {
      if (i != 0)
      {
        if (participants[parseInt(groupMovies[i].participant_id) - 1].name != "Micke")
        {
          continue;
        }
      }

    }
    catch (e)
    {
      console.log(e)
    }

    try
    {
      concattedString = "";
      for (var j = i; j > 0; j--)
      {
        concattedString += participants[parseInt(groupMovies[j].participant_id) - 1].name + " ";

        if (participants[parseInt(groupMovies[j - 1].participant_id) - 1].name == "Micke")
        {
          break;
        }
      }
    }
    catch (e)
    {
      console.log(e)
    }

    var is_major = "Big";
    if (groupMovies[i].is_mayor == 0)
    {
      is_major = "Small";
    }

    tempMovieList.push(
    {
      "id" : groupMovies[i].id,
      "movie" : groupMovies[i].movie,
      "genre" : groupMovies[i].genre,
      "imdb_rating" : groupMovies[i].imdb_rating,
      "jayornay" : groupMovies[i].jayornay,
      "picked_by" : participants[parseInt(groupMovies[i].picked_by) - 1].name,
      "participants" : concattedString,
      "is_major" : is_major
    });
  }
  return tempMovieList;
}

function CreateGroupTable()
{
  var movies = CleanGroupArray().reverse();
  const table = CleanTable(TableType.Group);

  var end_index = group_section_index * section_mult + section_mult - 1;
  var start_index = group_section_index * section_mult;
  if (end_index > movies.length)
  {
    group_section_index = group_section_index - 1;
    end_index = movies.length - 1;
  }
  if (start_index < 0)
  {
    start_index = 0;
  }
  if (start_index > movies.length)
  {
    start_index = movies.length;
  }

  for (var i = end_index; i >= start_index; i--)
  {
    var row = table.insertRow(1);
    row.classList.add('tableRow');

    cell0 = row.insertCell(0);
    cell1 = row.insertCell(1);
    cell2 = row.insertCell(2);
    cell3 = row.insertCell(3);
    cell4 = row.insertCell(4);
    cell5 = row.insertCell(5);
    cell6 = row.insertCell(6);
    cell7 = row.insertCell(7);

    cell0.innerHTML = movies[i].id;
    cell1.innerHTML = movies[i].movie;
    cell2.innerHTML = movies[i].genre;
    cell3.innerHTML = movies[i].imdb_rating;
    cell4.innerHTML = movies[i].jayornay;
    cell5.innerHTML = movies[i].picked_by;
    cell6.innerHTML = movies[i].participants;
    cell7.innerHTML = movies[i].is_major;

    cell0.classList.add('tableCell');
    cell1.classList.add('tableCell');
    cell2.classList.add('tableCell');
    cell3.classList.add('tableCell');
    cell4.classList.add('tableCell');
    cell5.classList.add('tableCell');
    cell6.classList.add('tableCell');
    cell7.classList.add('tableCell');
  }
}
function CleanMarvelArray()
{
  var tempMovieList = [];
  var num_ratings = 0;
  var avg_rating = 0;
  for (var i = marvelMovies.length - 1; i >= 0; i--)
  {
    if (i < 0)
    {
      break;
    }
    if (i == 0)
    {
      num_ratings = num_ratings + 1;
      avg_rating = (avg_rating + marvelMovies[i].user_rating) / num_ratings;
      concattedString += participants[parseInt(marvelMovies[i].participant_id) - 1].name + " ";
      continue;
    }
    try
    {
      if (i != 0)
      {
        if (participants[parseInt(marvelMovies[i].participant_id) - 1].name != "Micke")
        {
          avg_rating = marvelMovies[i].user_rating;
          continue;
        }
      }

    }
    catch (e)
    {
      console.log(e)
    }

    console.log(avg_rating)
    try
    {
      concattedString = "";
      for (var j = i; j > 0; j--)
      {
        concattedString += participants[parseInt(marvelMovies[j].participant_id) - 1].name + " ";
        num_ratings = num_ratings + 1;
        avg_rating = (avg_rating + marvelMovies[i].user_rating) / num_ratings;

        if (participants[parseInt(marvelMovies[j - 1].participant_id) - 1].name == "Micke")
        {
          break;
        }
      }
    }
    catch (e)
    {
      console.log(e)
    }

    tempMovieList.push(
    {
      "id" : marvelMovies[i].id,
      "movie" : marvelMovies[i].movie,
      "imdb_rating" : marvelMovies[i].imdb_rating,
      "user_rating" : avg_rating.toFixed(2),
      "participants" : concattedString,
    });
  }
  return tempMovieList;  
}

function CreateMarvelTable()
{
  var movies = CleanMarvelArray().reverse();
  const table = CleanTable(TableType.Marvel);

  var end_index = marvel_section_index * section_mult + section_mult - 1;
  var start_index = marvel_section_index * section_mult;
  if (end_index > movies.length)
  {
    marvel_section_index = marvel_section_index - 1;
    end_index = movies.length - 1;
  }
  if (start_index < 0)
  {
    start_index = 0;
  }
  if (start_index > movies.length)
  {
    start_index = movies.length;
  }

  for (var i = end_index; i >= start_index; i--)
  {
    var row = table.insertRow(1);
    row.classList.add('tableRow');

    cell0 = row.insertCell(0);
    cell1 = row.insertCell(1);
    cell2 = row.insertCell(2);
    cell3 = row.insertCell(3);
    cell4 = row.insertCell(4);

    cell0.innerHTML = movies[i].id;
    cell1.innerHTML = movies[i].movie;
    cell2.innerHTML = movies[i].user_rating;
    cell3.innerHTML = movies[i].imdb_rating;
    cell4.innerHTML = movies[i].participants;

    cell0.classList.add('tableCell');
    cell1.classList.add('tableCell');
    cell2.classList.add('tableCell');
    cell3.classList.add('tableCell');
    cell4.classList.add('tableCell');
  }
}

function CreateSoloTable()
{
  //console.log("CreateTable() Called.");
  const table = CleanTable(TableType.Solo);

  //for each movie fetched, add new row with said movie info.
  for (var i = 0; i < soloMovies.length; i++)
  {
    var row = table.insertRow(1);
    row.classList.add('tableRow');

    cellName = row.insertCell(0);
    cellGrade = row.insertCell(1);
    cellRating = row.insertCell(2);

    cellName.innerHTML = soloMovies[i].name;
    cellGrade.innerHTML = soloMovies[i].jayornay;
    cellRating.innerHTML = soloMovies[i].rating;

    cellName.classList.add('tableCell');
    cellGrade.classList.add('tableCell');
    cellRating.classList.add('tableCell');
  }
}

function SortTable(n, tableID)
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
  var table;

  switch(tableID)
  {
    case 'group':
      table = document.getElementById("groupMovie");
    break;
    case 'marvel':
      table = document.getElementById("marvelMovie");
    break;
    case 'solo':
      table = document.getElementById("soloMovie");
    break;
    default: console.log("Error occurred.");
  }

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
        if(tableID == 'marvel')
        {
          if (n === 1 || n === 2)
          {
            if (Number(x.innerHTML) > Number(y.innerHTML)) 
            {
              // If so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          } 
          else if (n === 3)
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
        else if (tableID == 'group')
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
        else if (tableID == 'solo')
        {
          if (n === 1 || n === 2)
          {
            if (Number(x.innerHTML) > Number(y.innerHTML)) 
            {
              // If so, mark as a switch and break the loop:
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
      } 
      else if (dir == "desc") 
      {
        if(tableID == 'marvel')
        {
          if (n === 1 || n === 2) 
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
        else if (tableID == 'group')
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
        else if (tableID == 'solo')
        {
          if (n === 1 || n === 2) 
          {
            if (Number(x.innerHTML) < Number(y.innerHTML)) 
            {
              // If so, mark as a switch and break the loop:
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

function FetchParticipants(name = null)
{
  participants = [];
  params = new URLSearchParams();

  if(name != null)
    {params.append('name', name);}

  fetch(`http://${host}/api/participants.php?${params}`)
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
    participants.sort((a, b) => a.id - b.id)

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

  fetch(`http://${host}/api/genres.php?${params}`)
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

function FetchSolo()
{
  const params = new URLSearchParams();
  soloMovies = [];

  isFetching = true;

  fetch(`http://${host}/api/solo_movies.php?${params}`)
  .then(response => response.json())
  .then(data => 
  {
    results = data
    console.log(results);

    for (var i = 0; i < results['data'].length; i++)
    {
      var temp = JSON.parse(results['data'][i]);

      soloMovies.push(new Solo_movie(temp.id ,temp.participant_id, temp.participant, temp.user_rating, temp.imdb_rating, temp.movie, temp.description, temp.cover_path));
    }
    PopulateTable('Solo');
  })
}

function FetchGroup()
{
  const params = new URLSearchParams();
  groupMovies = [];

  isFetching = true;

  fetch(`http://${host}/api/group_movies.php?${params}`)
  .then(response => response.json())
  .then(data => 
  {
    results = data;
    console.log(results);

    for (var i = 0; i < results['data'].length; i++)
    {
      var temp = JSON.parse(results['data'][i]);

      groupMovies.push(new Group_movie(temp.id ,temp.participant_id, temp.participant, temp.genre, temp.picked_by, temp.movie, temp.imdb_rating, temp.description, temp.jayornay , temp.is_mayor, temp.cover_path));
    }
    PopulateTable('Group');
  })
}

function FetchMarvel()
{
  const params = new URLSearchParams();
  marvelMovies = []

  isFetching = true;

  fetch(`http://${host}/api/marvel_movies.php?${params}`)
  .then(response => response.json())
  .then(data => 
  {
    results = data
    console.log(results);

    for (var i = 0; i < results['data'].length; i++)
    {
      var t = JSON.parse(results['data'][i]);
      marvelMovies.push(new Marvel_movie(t.id ,t.participant_id, t.participant, t.user_rating, t.imdb_rating, t.movie, t.description, t.cover_path));
    }
    PopulateTable('Marvel');
  })
}

function GetMovies(name = null,  genre = null, rating = null, jayornay = null, picker = null, participant = null, type = null)
{

  isFetching = true;

  fetch(`http://${host}/api/movies.php?${params}`)
  .then(response => response.json())
  .then(data => 
  {
    results = data;
    /*
    for (var i = 0; i < results['data']['group'].length; i++)
    {
      var testParticipants = Array();
      var tempObject = JSON.parse(results['data']['group'][i]);

      moviesGroup.push(new Movie(tempObject.id, tempObject.name, tempObject.genre, tempObject.rating, 
        tempObject.jayornay, tempObject.picker, tempObject.participants, tempObject.type, tempObject.description, tempObject.cover_path));
    }

    for (var i = 0; i < results['data']['marvel'].length; i++)
    {
      var tempObject = JSON.parse(results['data']['marvel'][i]);

      moviesMarvel.push(new Movie(null ,tempObject.name, null, tempObject.rating, tempObject.grade, null, tempObject.participants));
    }

    for (var i = 0; i < results['data']['solo'].length; i++)
    {
      var tempObject = JSON.parse(results['data']['solo'][i]);

      moviesSolo.push(new Movie(tempObject.id, tempObject.name, null, tempObject.rating, tempObject.grade));
    }
    */
    isFetching = false;
  })
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

    fetch(`http://${host}/api/movies.php`,
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

FetchParticipants();
FetchMarvel();
FetchGroup();
FetchSolo();