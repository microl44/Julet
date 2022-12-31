<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "includers/basic.php";
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "function.php";
	include_once "includers/header.php";

	RunOnAllPages();
	
	if(isset($_SESSION['username']) || isset($_SESSION['password']))
	{
		addLog();
		echo "<div class='content'>";
			global $conn;
			$stmt = $conn->query("SELECT name FROM participant");
			$participants = $stmt->fetchAll();
			$stmt->closeCursor();

			echo "<div class='gridContainer'>";
			foreach($participants as $participant)
			{
				if($participant['name'] != "UNK")
				{
					PrintParticipantInfo($participant);
				}
			}
			echo "</div>";
		echo "</div>";
		include_once "includers/footer.php";
	}
	else
	{
		notLoggedIn();
	}
?>