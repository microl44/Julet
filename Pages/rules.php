<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "../includers/basic.php";
	require_once "../includers/header.php";

	$generalInfo = "The following is the rules of the Jul/Wheel/Christmas: A Genre-Jul is spun to determine what genre the Jul will be. Then each participant will have roughly 15 minutes to pick a movie within that genre and bring it to the wheel.";
	$titles = array("Regular Wheel (2+)", 
		"Reverse Wheel (2+)", 
		"Dealers choice (3+)", 
		"Multi-choice Wheel (1+)", 
		"Reverse Multi-wheel of madness (1+)", 
		"Reverse-Genre Wheel Of Reverse Madness (1+)", 
		"Tag-Team Wheel (3+)", 
		"Bogo-Wheel (2+)", 
		"Streaming Site Jul (2+)",
		"Time-Wheel (1+)",
		"Winner Wheel (2+)",
		"Custom Wheel");
	$descriptions = array("This is a simple Jul. Each participant brings a single movie to the Jul, the Jul is spun and whatever movie it lands on is the winner.",
						"Reverse Jul. Every participant brings a movie to the Jul, the Jul is spun and the winning result is removed from the Jul. The Jul is then re-spun until only 1 remains which is the winner.",
						"Each user brings a movie to the Jul, but instead of spinning the movies, the users names are spun. The one it lands on gets to decide between the movies the other users brought.", 
						"Each user brings more than one movie to the Jul. Can be combined with other rules to create Reverse-Multi-Wheels of madness.",
						"Each user brings multiple movies (often 3 or 5), either from the same or diffrent genres, and one movie is removed per roll. God help you if you don't have 30 minutes to spare.", 
						"Every user bring 3-5 genres to the Jul and a reverse Jul is spun. Then each user brings 3-5 movies from the remaining genre and a revser Jul is spun again. WARNING! WILL TAKE AT LEAST 30 MINUTES.",
						"First a Jul is spun between the participant and whoever it lands on decides the genre. The rest of the participants bring a movie of the chosen genre and a regular Jul is spun to determine the winner.", 
						"Regular or reverse Jul with a number of \"RESET\" entries. If the RESET entry is chosen, the previous user-brought entries are disqualified and new entries must be brought.", 
						"Instead of movies, streaming sites are either brought to the Jul, or a complete list of streaming sites are brought to be rolled. The chosen streaming site is used to select movies for further Jul.", 
						"Every full hour is added to a wheel (00 - 24) and a wheel is then spun. A normal wheel is then spun at the rolled hour of the next day.",
						"The name of the participants are added to the Jul and the Jul is then spun. Whoever it lands on gets to pick a movie for a secondary Jul from any genre. The Jul is then respun until X amount of movies exists on the secondary Jul. The secondary Jul is then spun and a winning movie is chosen.", 
						"Custom rules are prepared beforehand in terms of movie selection criterias. Too specific to handle all cases and it's represented as 'CUSTOM RULES' in the movie table.",);

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

		<script type="text/javascript" src="rules.js"></script>
		<?php

		include_once("../includers/footer.php");
	}	
else
{
	notLoggedIn();
}
?>
<script type="text/javascript" src="../includers/basic.js"></script>
</body>