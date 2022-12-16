<?php
require_once "loginFunctions.php";
?>
<script type="text/javascript" src="file.js"></script>
<link type="text/css" href="Shared/style.css" rel="stylesheet">
<script type="text/javascript" src="./Shared/general.js"></script>
<header>
	<div class='navbar'>
		<!-- MAIN PAGE REDIRECTION LINKS START-->
		<a href="index.php"> HOME </a>
		<a href="stats.php"> STATS </a>
		<a href="movies.php"> MOVIES </a>
		<!-- MAIN PAGE REDIRECTION LINKS END-->

		<!-- LOGIN FORM START -->
		<div id='loginDiv'>
			<?php
				if(isset($_SESSION['username']))
				{
					echo "<a href='logout.php'>LOGOUT</a>";
				}
				else
				{
					if(isset($_POST['username']))
					{
						LoginAttempt($_POST['username'],$_POST['password']);
						header('location: ./index.php');
						die();
					}?>

				 	<form action='index.php' method='POST'>
						<label for='username'>Username: </label>
						<input type='text' name='username'/>

						<label for='password'>Password: </label>
						<input type='password' name='password'/>

						<input type='submit' value='login'/>
				 	</form>
				<?php
				}?>
		</div>
		<!-- LOGIN FORM END -->
	</div>
</header>