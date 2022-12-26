<?php
if(!isset($_SESSION))
{ session_start();}

require_once "loginFunctions.php";
require_once "includers/basic.php";
require_once "functions.php"


?>
<link type="text/css" href="Shared/style.css" rel="stylesheet">
<head>
	<link rel="shortcut icon" href="Shared/icons/tree2.png">
	<?php 
		echo "<title>".$titles[rand(0,count($titles)-1)]."</title>";
	?>
	<title>Nu är det hjul igen</title>
	<div class='navbar'>
		<!-- MAIN PAGE REDIRECTION LINKS START-->
		<a class='navbarLink' href="index.php"> HOME </a>
		<a class='navbarLink' href="stats.php"> STATS </a>
		<a class='navbarLink' href="movies.php"> MOVIES </a>
		<a class='navbarLink' href="rules.php"> JUL-RULES </a>
		<a class='navbarLink' href="jul.php"> JUL-JUL </a>
		<?php 
			echo "<div style='float:right; position: fixed; font-size: 40px; margin-left: 75%; margin-top: 5%;transform: rotate(20deg);'>
				<p style='font-size: 30px; font-weight: bold; '>".$quote['Quote']."</p>
				<p style='font-size: 20px; margin-top: -20px;'> -".$quote['Author']."</p>
			</div>";
		?>
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
</head>
<body>