<?php
if(!isset($_SESSION))
{ session_start();}

require_once "loginFunctions.php";
require_once "includers/basic.php";

$titles = array("Nu är det hjul igen!", "Wheel giveth, Wheel taketh", "Antman 2 is garbage", "Any similarities to holidays, living or dead, is purely coincidental!");

$quotes = array("Nu är det hjul igen, nu är det hjul igen, hjulen varar fram till kl 23.00", "Antman 2 är hot garbage", "Any similarities to real holidays is purely coincidental.", 
"The better jul", "Seeing the 4th movie first should be illegal", "I have a dream, that a movie shall not be judged by the image on the cover, but by the content of the story!",
"Höhöhö sån färg borde man ha", "Linus vinner alltid", "Linus vinner aldrig", "I created Ultron, and I'd do it again!", "It's the ballot or the wheel!", 
"The greatest trick the devil played was making humans believe the wheel wasn't rigged", "The wheel is probably not rigged. Probably...",
"It is during our darkest moments that we must focus to see the light", "Thanos should've won", "Yeah Spider-Man was great and all but have you seen Black Widow?",
"Om en funktion saknas så var det helt enkelt en fråga om prioriteringar", "Do you think god stays in heaven because he too lives in fear of what he's created?", 
"It's like printing my own money!","i volunteer as tribute!", "Screaming goats are fucking hillarious!", "The council will decide on your fate", 
"I hearby sentence you to eternal damnation!", "Gentlemen, it's with great pleasure to imform you that I just won the wheel", "Allt är Henriks fel!", "REEEEEEEEEEEEEEEEEEEEEE", 
"Gabbe köp en riktig stol för fan!", "Where is the server goblin when you need him?", "Bro It's like gambling but I literally can't lose!", "Du är för dålig för att snurra hjul",
"Ant-Man could've easily defated Thanos if he just jumped int-", "Because that's what heroes do", "do you know how much I've sacrificed!?",
"Fun Isn’t Something One Considers When programming in JavaScript. But This… Does Put A Smile On My Face.", "I'm a survivor", "Asså, vi har ett alvarligt problem!", 
"Eyy Behrad, kör DS3 DLC istället för att sitta här", "I think I'm gonna die out here", "Due to budget cuts we must band together, as a family, and reallocate all profits to my bank account",
"Imagine att spendera 180kr för att se Ant-Man 2 på bio HÖHÖHÖ", "A constant? Of course it is, I haven't touched it yet", "I'm tired boss, dog tired...", "WILDCARD BITCHES! YEE-HAW!",
"I will eat your babies, bitch!", "I have a PDH in cryptography *shows code*", "I really liked \"Lincoln\" (2012) but I just wish they didn't make it so political" );
$quotees = array("Abraham Lincoln", "Winston Churchill", "Martin Luther King (jr)", "Santa", "Behrad", "Tony Stark", "Linus", "Malcolm X", "He who never wins", "Michael Bay",
"Micke", "Gabbe", "Crippe", "Momme", "Julius Caesar", "Disney", "Captain Glock", "Thor", "Spider-Man", "Stephen Hawking", "Margaret Thatcher", "George Washington", "Thanos");


$randomQuote = $quotes[rand(0, count($quotes)-1)];
$randomQuotee = $quotees[rand(0, count($quotees)-1)];
if($randomQuote == "It is during our darkest moments that we must focus to see the light")
{
	$randomQuotee = "Guy who never won";
}
else if($randomQuote == "Do you think god stays in heaven because he too lives in fear of what he's created?")
{
	$randomQuotee = "Behrad, när någon pillrar på install.php";
}
else if($randomQuote == "It's like printing my own money!")
{
	$randomQuotee = "Disney";
}
else if($randomQuote == "i volunteer as tribute!")
{
	$randomQuotee = "Black Widow";
}
else if($randomQuote == "I hearby sentence you to eternal damnation!")
{
	$randomQuotee = "Julrådet straffar Momme (colorized) (2022)";
}
else if($randomQuote == "Bro It's like gambling but I literally can't lose!")
{
	$randomQuotee = "Linus, när han köper boosters";
}
else if($randomQuote == "Du är för dålig för att snurra hjul")
{
	$randomQuotee = "Micke, till alla andra";
}
else if($randomQuote == "do you know how much I've sacrificed!?")
{
	$randomQuotee = "Pol Pot";
}
else if($randomQuote == "I'm a survivor")
{
	$randomQuotee = "Micke & Linus efter projektet";
}
else if($randomQuote == "Asså, vi har ett alvarligt problem!")
{
	$randomQuotee = "Mats & Denna sida";
}
else if($randomQuote == "A constant? Of course it is, I haven't touched it yet")
{
	$randomQuotee = "Python";
}
else if($randomQuote == "I'm tired boss, dog tired...")
{
	$randomQuotee = "Micke, efter att ha kommit på puns för 5 filmer";
}
else if($randomQuote == "WILDCARD BITCHES! YEE-HAW!")
{
	$randomQuotee = "Guy pushing directly to main";
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