<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Content-Type:application/json");

require_once "../includers/basic.php";
require_once "models/group_movies.php";

if(isset($_GET))
{
	try
	{
		$conn = GetConn();
		$results = array();
		$results['data'] = array();

		$time_start = microtime(true);

		$sql = "SELECT * FROM group_movie_participants";
		$stmt = $conn->prepare($sql);
		$result = $stmt->execute();

		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start)/60;
		#echo "<b>Database stuff: Total Execution Time:</b> ".$execution_time." Mins";
		#echo "<br></br>";

		if($result)
		{	
			$time_start = microtime(true);

			foreach($stmt->fetchAll() as $row)
			{
				$group_movie = new group_movie($conn);

				$group_movie->id = $row['id'];
				$group_movie->participant_id = $row['participant id'];
				$group_movie->participant = $row['participant'];
				$group_movie->genre = $row['genre'];
				$group_movie->picked_by =$row['picked by'];
				$group_movie->movie = $row['movie'];
				$group_movie->imdb_rating = $row['imdb rating'];
				$group_movie->description = $row['description'];
				$group_movie->jayornay = $row['Jay or Nay'];
				$group_movie->is_mayor = $row['is mayor'];
				$group_movie->cover_path = $row['cover path'];

				array_push($results['data'], json_encode($group_movie));
			}
			$time_end = microtime(true);
			$execution_time = ($time_end - $time_start)/60;
			#echo "<b>Creating Data Array Stuff: Total Execution Time:</b> ".$execution_time." Mins";
			#echo "<br></br>";
		}
		unset($_GET);

		$time_start = microtime(true);
		$jsonString = json_encode($results);

		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start)/60;
		#echo "<b>JSON encoding stuff: Total Execution Time:</b> ".$execution_time." Mins";
		#echo "<br></br>";

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