<?php
require_once "loginFunctions.php";
?>
<script type="text/javascript" src="file.js"></script>
<link type="text/css" href="Shared/style.css" rel="stylesheet">
<script type="text/javascript" src="./Shared/general.js"></script>
<header>
	<div class='navbar'>
		<!-- MAIN PAGE REDIRECTION LINKS START-->
		<a class='navbarLink' href="index.php"> HOME </a>
		<a class='navbarLink' href="stats.php"> STATS </a>
		<a class='navbarLink' href="movies.php"> MOVIES </a>
		<!-- MAIN PAGE REDIRECTION LINKS END-->

		<!-- LOGIN FORM START -->
		<div id='loginDiv'>
			<?php
				if(isset($_SESSION['username']))
				{
					echo "<form style='height: 100%;' action='logout.php' method='POST'>";
						echo "<input class='navbarLink logoutBtn' type='submit' value='LOGOUT'/>";
						echo "<input type='hidden' value='".$_SERVER['REQUEST_URI']."' name='url2'> </input>";
					echo "</form>";
				}
				else
				{
					if(isset($_POST['username']))
					{
						LoginAttempt($_POST['username'],$_POST['password']);
					}?>

					<form action='login.php' method='POST'>
					    <label for='username'>Username :</lable>
					    <input type='text' name='username'/>
					    <label for='password'>Password :</lable>
					    <input type='password' name='password'/>
					    <input type='submit' value='login'/> 

					    <?php echo "<input type='hidden' value='" . $_SERVER['REQUEST_URI'] . "' name='url'> </input>"; ?>
					</form>
				<?php
				}?>
		</div>
		<!-- LOGIN FORM END -->
	</div>
</header>