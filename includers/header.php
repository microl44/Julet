<?php
if(!isset($_SESSION))
{ session_start();}

require_once "loginFunctions.php";
require_once "includers/basic.php";
require_once "function.php";
$titles = array("Nu är det hjul igen!", "Wheel giveth, Wheel taketh", "Antman 2 is garbage", "Any similarities to holidays, living or dead, is purely coincidental!",
"En ännu mer spännande undertitel!", "Wheel 2, Electric Bogaloo");

$quote=giveRandomQuote();
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

		?>
		<!-- MAIN PAGE REDIRECTION LINKS END-->

		<!-- LOGIN FORM START -->
		<div id='loginDiv'>
			<?php include_once('login.php'); ?>
		</div>
		<!-- LOGIN FORM END -->
	</div>
</head>
<body>
	<script src='Javascript/functions.js'></script>