<?php
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";

	// test the function by scraping the cover art from the IMDB page
	$url = 'https://www.imdb.com/title/tt0298203/';
	$savePath = 'C:/xampp/htdocs/Julet/Shared/Images/cover.png';
	#scrapeCoverArt($url, $savePath);

?>
<div class='content'>
	<?php PrintMovies();?>
	<form action="movies.php" method="post" name="login-form">
		<input type="text" name="user" placeholder="Username" required />
		<input type="password" name="pass" placeholder="Password" required />
		<input type="submit" name="login" value="Login"/>
	</form>
</div>

