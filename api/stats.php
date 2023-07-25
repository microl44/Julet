<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Content-Type:application/json");

require_once "../includers/basic.php";
require_once "models/stats.php";

$sql_diff = "SELECT name, GREATEST((imdb_rating - rating), (rating - imdb_rating)) AS 'difference' FROM marvel_movies ORDER BY CAST(difference AS FLOAT) DESC LIMIT 1;";
$sql_most_favorites = "SELECT name, imdb_rating - rating AS 'difference' FROM marvel_movies ORDER BY CAST(difference AS FLOAT) ASC;";
$sql_least_favorites = "SELECT name, imdb_rating - rating AS 'difference' FROM marvel_movies ORDER BY CAST(difference AS FLOAT) DESC;";
$sql_biggest_haters = "SELECT name, (total_score / entries) as 'avg_score'
FROM (
    SELECT marvelparticipantID as 'userID', count(*) as 'entries' 
    FROM marvel_participated 
   GROUP BY marvelparticipantID) AS Jesus1 
INNER JOIN ( 
    SELECT mp1.marvelparticipantID as 'userID', p1.name, SUM(mp1.marvel_grade) AS 'total_score' 
    FROM marvel_participated AS mp1 
    INNER JOIN participant AS p1 
    ON mp1.marvelparticipantID = p1.id 
    GROUP BY marvelparticipantID) 
AS Jesus2 
ON Jesus1.userID = Jesus2.userID
WHERE Jesus1.entries > 10
ORDER BY avg_score ASC;";

$sql_smallest_haters = "SELECT name, (total_score / entries) as 'avg_score'
FROM (
    SELECT marvelparticipantID as 'userID', count(*) as 'entries' 
    FROM marvel_participated 
   GROUP BY marvelparticipantID) AS Jesus1 
INNER JOIN ( 
    SELECT mp1.marvelparticipantID as 'userID', p1.name, SUM(mp1.marvel_grade) AS 'total_score' 
    FROM marvel_participated AS mp1 
    INNER JOIN participant AS p1 
    ON mp1.marvelparticipantID = p1.id 
    GROUP BY marvelparticipantID) 
AS Jesus2 
ON Jesus1.userID = Jesus2.userID
WHERE Jesus1.entries > 10
ORDER BY avg_score DESC;";

if(isset($_GET))
{
	$conn = GetConn();
	$results = array();
	$results['data'] = array();

	$sql = $sql_diff;
	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();
	array_push($results['data'], json_encode(ExtractData($result, $stmt->fetchAll(PDO::FETCH_ASSOC), "Biggest Difference", false)));

	$sql = $sql_most_favorites;
	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();
	array_push($results['data'], json_encode(ExtractData($result, $stmt->fetchAll(PDO::FETCH_ASSOC), "Biggest Favorite", true)));

	$sql = $sql_least_favorites;
	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();
	array_push($results['data'], json_encode(ExtractData($result, $stmt->fetchAll(PDO::FETCH_ASSOC), "Least Favorite", true)));

	$sql = $sql_biggest_haters;
	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();
	array_push($results['data'], json_encode(ExtractData($result, $stmt->fetchAll(PDO::FETCH_ASSOC), "Biggest Haters", true)));

	$sql = $sql_smallest_haters;
	$stmt = $conn->prepare($sql);
	$result = $stmt->execute();
	array_push($results['data'], json_encode(ExtractData($result, $stmt->fetchAll(PDO::FETCH_ASSOC), "Smallest Haters", true)));

	unset($_GET);

	$jsonString = json_encode($results);
	echo $jsonString;
	die();
}

function ExtractData($result, $rows, $name, $isArray = false)
{
	if($result)
	{
		$stat = new Stat();
		$stat->content = Array();
		$stat->title = $name;
		if($isArray)
		{
			foreach($rows as $row)
			{
				array_push($stat->content, $row);
			}
		}
		else
		{
			$stat->content = $rows[0];
		}

		return $stat;
	}
	return;
}
?>