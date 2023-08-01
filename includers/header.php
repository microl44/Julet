<?php
if(!isset($_SESSION))
{ session_start();}

require_once dirname(__FILE__)."/basic.php";
require_once dirname(__FILE__)."/../function.php";

$titles = array("Nu är det hjul igen!", "Wheel giveth, Wheel taketh", "Antman 2 is garbage", "Any similarities to holidays, living or dead, is purely coincidental!",
"En ännu mer spännande undertitel!", "Wheel 2, Electric Bogaloo");

$colorScheme = "light";

$quote=giveRandomQuote();?>
<link type="text/css" href="../Shared/style.css" rel="stylesheet">
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
<head>
	<link rel="shortcut icon" href="../Shared/icons/tree2.png">
	<?php 
		echo "<title>".$titles[rand(0,count($titles)-1)]."</title>";
	?>
	<div class='navbar' id='navbar' style="z-index: 9000">
		<!-- MAIN PAGE REDIRECTION LINKS START-->
		<a class='navbarLink' id='navbarImage' href="index.php">
			<img src='../Shared/icons/tree2.png' width="50" height="50"/>
		</a>
		<button class='navbarLink' id='navbarBurger' onclick='ExpandHeader()'>
			<img style='float:left; margin-top: -5px;' src='../Shared/icons/burger.png' width="45" height="45"/>
			<p style='float:right; padding:0px; margin:0px; margin-left: 5px;'>Menu</p>
		</button>
		<a class='navbarLink' href="index.php"> HOME </a>
		<a class='navbarLink' href="stats.php"> STATS </a>
		<a class='navbarLink' href="movies.php"> MOVIES </a>
		<a class='navbarLink' href="rules.php"> JUL-RULES </a>
		<a class='navbarLink' href="jul.php"> JUL-JUL </a>
		<!-- MAIN PAGE REDIRECTION LINKS END-->

		<!-- LOGIN FORM START -->
		<div id='loginDiv'>
			<?php include_once('../login.php'); ?>
		</div>
		<!-- LOGIN FORM END -->

		<!-- NAVBAR MENU START -->
		<div id='navbarDropDown'>
			<br/>
			<br/>
			<br/>
			<br/>
			<H1 style='margin-left: 100px'> WORK IN POGRESS </H1>
			<H1 style='margin-left: 100px'> NAVBAR MENU WILL BE REPLACED WITH HAMBURGER MENU! </H1>
		</div>
		<!-- NAVBAR MENU END -->
	</div>
</head>
<body>