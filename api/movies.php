<?php
header("Content-Type:application/json");
require_once "../includers/basic.php";
require_once "models/movies.php";

function AppendAnd($counter, $sql)
{
	if($counter > 0)
	{
		return $sql . "AND ";
	}
	else{
		return "";
	}
}

function QueryBuilder()
{
	$sql = "SELECT * FROM movie WHERE ";
	$counter = 0;

	if(isset($_GET['picker']))
	{
		$sql = $sql . "picked_by = '". $_GET['picker'] . "' ";
		$counter = $counter + 1;
	}
	if(isset($_GET['name']))
	{
		$sql = AppendAnd($counter, $sql);
		$sql = $sql . "WHERE name LIKE '%".$_GET['name']."%'' ";
	}
	if(isset($_GET['jayornay']))
	{
		$sql = AppendAnd($counter, $sql);
		$sql = $sql . "jayornay = '". $_GET['jayornay'] . "' ";
	}
	if(isset($_GET['participant']))
	{
		$sql = AppendAnd($counter, $sql);
		$sql = $sql . "participants LIKE '%".$_GET['participant']."%' ";
	}

	$sql = $sql . "ORDER BY id ";

	if(isset($_GET['order']) == 'decending')
	{
		$sql = $sql . "DESC";
	}
	else
	{
		$sql = $sql . "ASC";
	}
	return $sql;
}

if(isset($_POST['link']) && isset($_POST['jayornay']) && isset($_POST['picker']) && isset($_POST['participants']) && isset($_POST['type']) && isset($_POST['genre']))
{
	try
	{
		$results = array();
		$results['data'] = array();
		$results['data']['operation'] = "";
		$results['data']['name'] = "";
		$results['data']['genre'] = "";
		$results['data']['rating'] = "";
		$results['data']['jayornay'] = "";
		$results['data']['picker'] = "";
		$results['data']['participants'] = "";
		$results['data']['type'] = 3;
		$results['data']['description'] = "";

		$conn = GetConn();
		$movie = new Movie($conn);
		$movie->jayornay = $_POST['jayornay'];
		$movie->genre = $_POST['genre'];
		$movie->picker = $_POST['picker'];
		$movie->participants = $_POST['participants'];
		$movie->type = $_POST['type'];

		$movie->Insert($_POST['link'], $conn);

		unset($_POST['link']);
		unset($_POST['jayornay']);
		unset($_POST['picker']);
		unset($_POST['participants']);
		unset($_POST['type']);
		unset($_POST['genre']);

		$results['data']['operation'] = "Operation: Movie Insertion - Success";
		$results['data']['name'] = $movie->name;
		$results['data']['genre'] = $movie->genre;
		$results['data']['rating'] = $movie->rating;
		$results['data']['jayornay'] = $movie->jayornay;
		$results['data']['picker'] = $movie->picker;
		$results['data']['participants'] = $movie->participants;
		$results['data']['type'] = $movie->type;
		$results['data']['description'] = $movie->description;

		#array_push($results['data'], $movie);
		$jsonString = json_encode($results); 
		echo $jsonString;
		die();
	}
	catch(PDOException $e)
	{
		echo json_encode($e->getMessage());
		die();
	}
}
else
{

}


if(isset($_GET['name']))
{
	$conn = GetConn();
	$results = array();
	$results['data'] = array();

	$sql = QueryBuilder();

	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();

	if($result)
	{	
		foreach($stmt->fetchAll() as $row)
		{
			$conn = GetConn();
			$movie = new Movie($conn);

			$movie->id = $row['id'];
			$movie->name = $row['name'];
			$movie->genre = $row['genre_name'];
			$movie->rating = $row['imdb_rating'];
			$movie->jayornay =$row['jayornay'];
			$movie->picker = $row['picked_by'];
			$movie->participants = $row['participants'];
			$movie->type = $row['is_major'];

			array_push($results['data'], json_encode($movie));
		}
	}
	unset($_GET);

	$jsonString = json_encode($results);
	echo $jsonString;
	die();
}