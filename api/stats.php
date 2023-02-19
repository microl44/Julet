<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Content-Type:application/json");

require_once "../includers/basic.php";
require_once "models/stats.php";

if(isset($_GET))
{
	$conn = GetConn();
	$results = array();
	$results['data'] = array();

	$sql = "SELECT * FROM participant";

	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();

	if($result)
	{	
		foreach($stmt->fetchAll() as $row)
		{
			$conn = GetConn();
			$participant = new Participant($conn);

			$participant->id = $row['id'];
			$participant->name = $row['name'];

			array_push($results['data'], json_encode($participant));
		}
	}
	unset($_GET);

	$jsonString = json_encode($results);
	echo $jsonString;
	die();
}
?>