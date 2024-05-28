<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Content-Type:application/json");

require_once "../includers/basic.php";
require_once "models/solo_movies.php";

function SetupStmtForSpecificUser($username)
{
	$conn = GetConn();
	$results = array();
	$results['data'] = array();
	$sql = "SELECT solo_movie_participants.id,`participant id`,`participant`,`user rating`,`imdb rating`,`movie`,`description`,`cover path` FROM solo_movie_participants
		inner join users on users.id = `user id`
		WHERE username = :username; ";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param(":username",$username);
	return; $stmt;
}

function setupStmtForGettingAll()
{
	$conn = GetConn();
	$results = array();
	$results['data'] = array();
	$sql = "SELECT DISTINCT 
	solo_movie_participants.id,
	`participant id`,
	`participant`,
	`user rating`,
	`imdb rating`,
	`movie`,
	`description`,
	`cover path` 
	FROM solo_movie_participants";
	$stmt = $conn->prepare($sql);
	return $stmt;
}

if(isset($_GET))
{
	try
	{
		$stmt = "";
		if(isset($_GET["username"]))
		{ 	
			$stmt = SetupStmtForSpecificUser($_GET["username"]); 
		}
		else
		{ 	
			$stmt = setupStmtForGettingAll(); 
		}		

		$results['data'] = array();
		$result = $stmt->execute();
		if($result)
		{	
			foreach($stmt->fetchAll() as $row)
			{
				$conn = GetConn();
				$solo_movie = new solo_movie($stmt);
				$solo_movie->id = $row['id'];
				$solo_movie->participant_id = $row['participant id'];
				$solo_movie->participant = $row['participant'];
				$solo_movie->user_rating = $row['user rating'];
				$solo_movie->imdb_rating = $row['imdb rating'];
				$solo_movie->movie = $row['movie'];
				$solo_movie->description = $row['description'];
				$solo_movie->cover_path = $row['cover path'];
				
				array_push($results['data'], json_encode($solo_movie));
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