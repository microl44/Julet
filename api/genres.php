<?php
header("Content-Type:application/json");
require_once "../includers/basic.php";
require_once "models/genres.php";

if(isset($_GET))
{
	$conn = GetConn();
	$results = array();
	$results['data'] = array();

	$sql = "SELECT name FROM genre";

	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();

	if($result)
	{	
		foreach($stmt->fetchAll() as $row)
		{
			$conn = GetConn();
			$genre = new Genre($conn);

			$genre->name = $row['name'];

			array_push($results['data'], json_encode($genre));
		}
	}
	unset($_GET);

	$jsonString = json_encode($results);
	echo $jsonString;
	die();
}