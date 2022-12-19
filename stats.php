<?php
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";

	if(isset($_SESSION['username']) || isset($_SESSION['password'])){
		echo "<div class='content'>";
		if(isset($_SESSION['username']) || isset($_SESSION['password'])){
			$conn = GetConnection();
			$stmt = $conn->query("SELECT name FROM participant");
			$participants = $stmt->fetchAll();
			$conn=null;
			
			echo "<div class='gridContainer'>";
			foreach($participants as $participant)
			{
				if($participant['name'] != "UNK")
				{
					PrintParticipantInfo($participant);
				}
			}
			echo "</div>";
		}
		else{
			notLoggedIn();
		}
		echo "</div>";
		include_once "includers/footer.php";
	}
	else{
		notLoggedIn();
	}
?>