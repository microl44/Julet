<?php
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";

	echo "<br/><br/><br/><br/><br/><br/>";
	$conn = CreateConn();
	$stmt = $conn->query("SELECT name FROM participant");
	$participants = $stmt->fetchAll();
	$conn=null;

	echo "<div class='gridContainer'>";
	foreach($participants as $participant)
	{
		$conn2 = CreateConn();
		$stmt2 = $conn2->query("CALL GetParticipationRate('" . $participant['name'] . "')");
		if($participant['name'] != "UNK")
		{
			foreach($stmt2->fetchAll() as $row)
			{
				PrintParticipantInfo($participant, $row);
			}
		}

	}
	echo "</div>";
?>