<?php
if(!isset($_SESSION))
{ session_start();}

require_once "../includers/basic.php";
require_once "../function.php";

$titles = array("Nu är det hjul igen!", "Wheel giveth, Wheel taketh", "Antman 2 is garbage", "Any similarities to holidays, living or dead, is purely coincidental!",
"En ännu mer spännande undertitel!", "Wheel 2, Electric Bogaloo");

$colorScheme = "light";

$quote=giveRandomQuote();?>
<script src='../Javascript/functions.js'></script>
<?php
	if(isset($_COOKIE['darkMode']))
	{
		//echo "<link type=\"text/css\" href=\"Shared/styleDark.css\" rel=\"stylesheet\">";
	}
	else
	{
		//echo "<link type=\"text/css\" href=\"Shared/style.css\" rel=\"stylesheet\">";
	}
?>
<link type="text/css" href="../Shared/style.css" rel="stylesheet">
<head>
	<link rel="shortcut icon" href="../Shared/icons/tree2.png">
	<?php 
		echo "<title>".$titles[rand(0,count($titles)-1)]."</title>";
	?>
	<div class='navbar' style="z-index: 90000">
		<!-- MAIN PAGE REDIRECTION LINKS START-->
		<a class='navbarLink' href="index.php"> HOME </a>
		<a class='navbarLink' href="stats.php"> STATS </a>
		<a class='navbarLink' href="movies.php"> MOVIES </a>
		<a class='navbarLink' href="rules.php"> JUL-RULES </a>
		<a class='navbarLink' href="jul.php"> JUL-JUL </a>
		<!-- MAIN PAGE REDIRECTION LINKS END-->

		<!-- LOGIN FORM START -->
		<div id='loginDiv'>
			<?php include_once('../login.php'); ?>
			<?php echo "hejsan"; ?>
		</div>
		<!-- LOGIN FORM END -->
	</div>
</head>
<body>