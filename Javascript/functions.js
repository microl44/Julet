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

function loginFunction()
{
    // Get form elements
    const form = document.querySelector('.login-form');
    const usernameInput = document.querySelector('#username');
    const passwordInput = document.querySelector('#password');

    // Submit handler
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Get form values
        const username = usernameInput.value;
        const password = passwordInput.value;

        // Validate values
        if(username.trim() === '' || password.trim() === '') {
            alert('Please enter valid credentials');
            return;
        }

        // Check credentials
        const sql = `SELECT * FROM users WHERE username = ? AND password = ?`;
        $conn->prepare(sql)->execute([username, password])
            .then((result) => {
                if(result.length > 0) {
                    alert('Login successful');
                }
                else {
                    alert('Login failed');
                }
            })
            .catch(err => console.log(err));
    });
}