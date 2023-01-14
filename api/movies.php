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
$jsonString = json_encode($results);

echo $jsonString;