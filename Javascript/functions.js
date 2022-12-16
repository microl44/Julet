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

function login() {
    const errMessage = document.getElementById("err-message");
 if(error) {
   errMessage.innerHTML = "Login failed! Please try again.";
 } else {
   errMessage.innerHTML = "Login successful!";
 }
}