<?php
if(!isset($_SESSION))
{
	session_start();
}

require_once "../includers/basic.php";
require_once "../loginFunctions.php";
require_once "../Database.php";
require_once "../function.php";
require_once "../includers/header.php";

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
		</div>
	</div>
<?php include_once "../includers/footer.php";
}
else
{
	notLoggedIn();
}?>
<script type="text/javascript" src="../includers/basic.js"></script>
<script type="text/javascript" src="movies.js"></script>