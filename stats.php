<?php
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";
	echo "<br/><br/><br/><br/><br/><br/>";
	$conn = CreateConn();
	$stmt = $conn->query("SELECT name FROM participant");
	$participants = $stmt->fetchAll();
	$conn=null;

	foreach($participants as $participant)
	{
		$conn2 = CreateConn();
		$stmt2 = $conn2->query("CALL GetParticipationRate('" . $participant['name'] . "')");
		foreach($stmt2->fetchAll() as $row)
		{
			//meningen att calla PrintParticipantInfo() i function.php som genererar en div som innehåller all information för användare X
			echo $participant['name'] . " " . $row['Participation rate'] . "%<br/>";
		} 
	}
?>