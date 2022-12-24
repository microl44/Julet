<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "includers/header.php";

	$generalInfo = "The following is the rules of the Jul/Wheel/Christmas: A Genre-Jul is spun to determine what genre the Jul will be. Then each participant will have roughly 15 minutes to pick a movie within that genre and bring it to the wheel.";
	$titles = array("Regular Wheel", "Reverse Wheel", "Custom Wheel", "Multi-choice Wheel");
	$descriptions = array("This is a simple wheel. Each participant brings a single movie to the Jul, the Jul is spun and whatever movie it lands on is the winner.",
						"Reverse whell. Every participant brings a movie to the Jul, the Jul is spun and the winning result is removed from the Jul. The Jul is then re-spun until only 1 remains which is the winner.", "Custom rules are prepared beforehand in terms of movie selection criterias. Too specific to handle all cases and it's represented as 'CUSTOM RULES' in the movie table.", "Each user brings more than one movie to the Jul. Can be combined with other rules to create Reverse-Multi-Wheels of madness.");

	if(isset($_SESSION['username']) || isset($_SESSION['password']))
	{?>
		<div class='content'>
			<div id='rulesDiv'>
				<ul class='rulesDisplay'>
					<?php
					for($itterator = 0; $itterator < count($titles); $itterator++)
					{
						echo "<div class='item'>";
							echo "<p>".$titles[$itterator]."</p>";
							echo "<p>".$descriptions[$itterator]."</p>";
						echo "</div>";
					}
					?>
				</ul>
			</div>
		</div>

		<?php
		include_once("includers/footer.php");
	}
	else
	{
		notLoggedIn();
	}
?>
</body>