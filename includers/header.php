<?php
if(!isset($_SESSION))
{ session_start();}

require_once "loginFunctions.php";
require_once "includers/basic.php";

$titles = array("Nu är det hjul igen!", "Wheel giveth, Wheel taketh", "Antman 2 is garbage", "Any similarities to holidays, living or dead, is purely coincidental!");

$quotes = array("Nu är det hjul igen, nu är det hjul igen, hjulen varar fram till kl 23.00", "Antman 2 är hot garbage", "Any similarities to real holidays is purely coincidental.", 
"The better jul", "Seeing the 4th movie first should be illegal", "I have a dream, that a movie shall not be judged by the color of the cover art, but by the content of the story!",
"Höhöhö sån färg borde man ha", "Linus vinner alltid", "Linus vinner aldrig", "I created Ultron, and I'd do it again!", "It's the ballot or the wheel!", 
"The greatest trick the devil played was making humans believe the wheel wasn't rigged", "The wheel is probably not rigged. Probably...",
"It is during our darkest moments that we must focus to see the light", "Thanos should've won", "Yeah Spider-Man was great and all but have you seen Black Widow?",
"Om en funktion saknas så var det helt enkelt en fråga om prioriteringar", "Do you think god stays in heaven because he too lives in fear of what he's created?", "It's like printing my own money!",
"i volunteer as tribute!", "Screaming goats are fucking hillarious!");
$quotees = array("Abraham Lincoln", "Winston Churchill", "Martin Luther King (jr)", "Santa", "Behrad", "Tony Stark", "Linus", "Malcolm X", "He who never wins", "Michael Bay",
"Micke", "Gabbe", "Crippe", "Momme", "Julius Caesar", "Disney", "Captain Glock");


$randomQuote = $quotes[rand(0, count($quotes)-1)];
$randomQuotee = $quotees[rand(0, count($quotees)-1)];
if($randomQuote == "It is during our darkest moments that we must focus to see the light")
{
	$randomQuotee = "Guy who never won";
}
if($randomQuote == "Do you think god stays in heaven because he too lives in fear of what he's created?")
{
	$randomQuotee = "Behrad, när någon pillrar på install.php";
}
if($randomQuote == "It's like printing my own money!")
{
	$randomQuotee = "Disney";
}
if($randomQuote == "i volunteer as tribute!")
{
	$randomQuotee = "Black Widow";
}
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
				<p style='font-size: 30px; font-weight: bold; '>".$randomQuote."</p>
				<p style='font-size: 20px; margin-top: -20px;'> -".$randomQuotee."</p>
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