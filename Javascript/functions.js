function hideOnScroll() {
window.onload = () => {
  const quoteDiv = document.querySelector('.quoteDiv');

  window.addEventListener('scroll', () => {
    const scrollPercentage = window.scrollY / document.body.offsetHeight
    if (scrollPercentage >= 0.2)
    {
      quoteDiv.style.transition = 'opacity 0.3s';
      quoteDiv.style.opacity = 0;
    } 
    else 
    {
      quoteDiv.style.opacity = 1;
    }
    console.log(scrollPercentage);
  });
};
}
hideOnScroll();

function showCards() {
    const card = document.querySelectorAll('.cards');
    let currentCard = 0;

    function showCard(cardIndex) {
        // Hide all cards
    cards.forEach(card => 
    {
        card.style.display = 'none';
    });
        // Show the current card
        cards[cardIndex].style.display = 'block';
    }

    // Show the first card
    showCard(currentCard);

    const nextBtn = document.querySelector('#nextBtn');
    const prevBtn = document.querySelector('#prevBtn');

    nextBtn.addEventListener('click', () => 
    {
        currentCard = (currentCard + 1) % cards.length;
        showCard(currentCard);
    });

    prevBtn.addEventListener('click', () => 
    {
        currentCard = (currentCard - 1 + cards.length) % cards.length;
        showCard(currentCard);
    });
}
function getMovieData() 
{
    let imdbLink = document.getElementById('imdb-link-input').value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            parser = new DOMParser();
            htmlDoc = parser.parseFromString(this.responseText, "text/html");
            let title = htmlDoc.querySelector('[data-testid="hero-title-block__title"]');
            let grade = htmlDoc.querySelector('[class="sc-7ab21ed2-1 jGRxWM"]');
            console.log("The movie has a name of "+title.innerText+" and a grade of "+grade.innerText);
        }
    };
    xhttp.open("GET", imdbLink, true);
    xhttp.send();
}

var sortOrder = 'ascending';

function sortTable(column) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementsByClassName("Table")[0];
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[column];
      y = rows[i + 1].getElementsByTagName("TD")[column];
      //check if the two rows should switch place:
      if (column === 0 || column === 3) {
        // Sort numerically
        if (sortOrder === 'ascending') {
          if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
            shouldSwitch = true;
            break;
          }
        } else {
          if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
            shouldSwitch = true;
            break;
          }
        }
      } else if (column !== 8) {
        // Sort alphabetically
        if (sortOrder === 'ascending') {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        } else {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
  // Reverse the sort order
  sortOrder = (sortOrder === 'ascending') ? 'descending' : 'ascending';
}

var items = document.getElementsByClassName("TableHeader")

if(items.length > 0)
{
    document.getElementsByClassName("TableHeader")[0].addEventListener("click", function() {
      sortTable(0);});
    document.getElementsByClassName("TableHeader")[1].addEventListener("click", function() {
      sortTable(1);});
    document.getElementsByClassName("TableHeader")[2].addEventListener("click", function() {
      sortTable(2);});
    document.getElementsByClassName("TableHeader")[3].addEventListener("click", function() {
      sortTable(3);});
    document.getElementsByClassName("TableHeader")[4].addEventListener("click", function() {
      sortTable(4);});
    document.getElementsByClassName("TableHeader")[5].addEventListener("click", function() {
      sortTable(5);});
    document.getElementsByClassName("TableHeader")[6].addEventListener("click", function() {
      sortTable(6);});
    document.getElementsByClassName("TableHeader")[7].addEventListener("click", function() {
      sortTable(7);});
}