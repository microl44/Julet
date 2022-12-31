<?php
	session_start();
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";
	require_once "includers/basic.php";
	
	RunOnAllPages();
	// test the function by scraping the cover art from the IMDB page
	#$url = 'https://www.imdb.com/title/tt0910970/?ref_=nv_sr_srsg_4';
	#$savePath = 'C:/xampp/htdocs/Julet/Shared/Images/cover.png';
	#scrapeCoverArt($url, $savePath);


if(isset($_SESSION['username']) || isset($_SESSION['password']))
{
	addLog();?>
	<div class='content'>
		<div class='moviePageWrapper'>
			<?php PrintMovies();?>
			<form action="movies.php" method="post" name="login-form">
				<input type="text" name="user" placeholder="Username" required />
				<input type="password" name="pass" placeholder="Password" required />
				<input type="submit" name="login" value="Login"/>
			</form>
		</div>
	</div>
<?php include_once "includers/footer.php";
}
else
{
	notLoggedIn();
}
