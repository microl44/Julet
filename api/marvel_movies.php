<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Content-Type:application/json");

require_once "../includers/basic.php";
require_once "models/marvel_movies.php";

if(isset($_GET))
{
	try
	{
		$conn = GetConn();
		$results = array();
		$results['data'] = array();

		$sql = "SELECT * FROM marvel_participants";
		$stmt = $conn->prepare($sql);
		$result = $stmt->execute();

		if($result)
		{	
			foreach($stmt->fetchAll() as $row)
			{
				$conn = GetConn();
				$marvel_movie = new marvel_movie($conn);

				$marvel_movie->id = $row['id'];
				$marvel_movie->participant_id = $row['participant id'];
				$marvel_movie->participant = $row['participant'];
				$marvel_movie->genre = $row['user rating'];
				$marvel_movie->picked_by =$row['imdb rating'];
				$marvel_movie->movie = $row['movie'];
				$marvel_movie->description = $row['description'];
				$marvel_movie->cover_path = $row['cover path'];

				array_push($results['data'], json_encode($marvel_movie));
			}
		}
		unset($_GET);

		$jsonString = json_encode($results);

		if(json_last_error() === JSON_ERROR_NONE)
		{
			echo $jsonString;
			die();
		}
		else
		{
			throw new Exception('Fucky Wucky');
		}
	}
	catch(Exception $e)
	{
		echo json_encode($e);
		die();
	}
}
?>