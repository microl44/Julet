<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "../includers/basic.php";
	require_once "../includers/header.php";

	$generalInfo = "The following is the rules of the Jul/Wheel/Christmas: A Genre-Jul is spun to determine what genre the Jul will be. Then each participant will have roughly 15 minutes to pick a movie within that genre and bring it to the wheel.";
	$titles = array("Regular Wheel", "Reverse Wheel", "Dealers choice", "Custom Wheel", "Multi-choice Wheel", "Reverse Multi-wheels of madness");
	$descriptions = array("This is a simple wheel. Each participant brings a single movie to the Jul, the Jul is spun and whatever movie it lands on is the winner.",
						"Reverse wheel. Every participant brings a movie to the Jul, the Jul is spun and the winning result is removed from the Jul. The Jul is then re-spun until only 1 remains which is the winner.",
						"Each user brings a movie to the wheel, but instead of spinning the movies, the users names are spun. The one it lands on gets to decide between the movies the other users brought.",
						"Custom rules are prepared beforehand in terms of movie selection criterias. Too specific to handle all cases and it's represented as 'CUSTOM RULES' in the movie table.", "Each user brings more than one movie to the Jul. Can be combined with other rules to create Reverse-Multi-Wheels of madness.",
						"Each user brings multiple movies (often 3 or 5), either from the same or diffrent genres, and one movie is removed per roll. God help you if you don't have 30 minutes to spare.");

	if(isset($_SESSION['username']) || isset($_SESSION['password']))
	{
		addLog()?>
		<div class='content'>
			<div class='rulesDiv'>
				<ul class='rulesDisplay'>
					<?php
					for($itterator = 0; $itterator < count($titles); $itterator++)
					{
						echo "<div class='item'>";
							echo "<button class='prevRuleBtn'><div class='prevArrow'><p><</p></div></button>";
							echo "<div class='itemText'>";
								echo "<p style='font-weight: bold;'>".$titles[$itterator]."</p>";
								echo "<p>".$descriptions[$itterator]."</p>";
							echo "</div>";
							echo "<button class='nextRuleBtn'><div class='nextArrow'><p>></p></div></button>";
						echo "</div>";
					}
					?>
				</ul>
			</div>
		</div>

		<?php
		include_once("../includers/footer.php");
	}	
else
{
	notLoggedIn();
}
?>
</body>