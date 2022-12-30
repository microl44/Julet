<?php
if(!isset($_SESSION))
{
	session_start();
}

require_once "includers/basic.php";
require_once "includers/header.php";
require_once "function.php";

if(exists($_POST['addName']) && exists($_POST['addGenre']))
{
	InsertMovie();
}
else if(exists($_POST['deleteId']))
{
	DeleteMovie();
}
header('Location: index.php');

function InsertMovie()
{
	$tempDescription = null; 
	$count = 0;
	try{
		$conn = GetConnection();
		if(isset($_POST['addName']) && isset($_POST['addGenre']) && isset($_POST['addPickedBy']) && isset($_POST['addIs_major']))
		{
			$savePath = 'C:/xampp/htdocs/Julet/Shared/Images/cover.png';
			$title = null;
			$grade = null;
			try{
				if (exists($_POST['addName'])) 
				{
					$count = scrapeCoverArt($_POST['addName'], $savePath);
				    $imdbLink = $_POST['addName'];
				    $html = file_get_contents($imdbLink);
				    $dom = new DOMDocument();
				    @$dom->loadHTML($html);
				    $xpath = new DOMXPath($dom);
				    $tempDescription = $xpath->query('//span[@class="sc-16ede01-1 kgphFu"]')->item(0)->nodeValue;
				    $tempTitle = $xpath->query('//*[@data-testid="hero-title-block__title"]')->item(0);
				    $tempGrade = $xpath->query('//span[@class="sc-7ab21ed2-1 jGRxWM"]')->item(0);
				    $title = $tempTitle->nodeValue;

				    if(exists($xpath->query('//*[@data-testid="hero-title-block__original-title"]')->item(0)->nodeValue))
				    {
				   		$title = substr($xpath->query('//*[@data-testid="hero-title-block__original-title"]')->item(0)->nodeValue, 16);
				    }
				    else
				    {
				    	$title = $xpath->query('//*[@data-testid="hero-title-block__title"]')->item(0)->nodeValue;
				    }
				    $grade = $tempGrade->nodeValue;
				    $sql = "INSERT INTO movieDescription(movieID, genre_name, imdb_rating, jayornay, picked_by, participants, is_major)";
				}
			}
			catch(Exception $e)
			{
				print_r($e);
				die();
			}
			try
			{
				$sql = "INSERT INTO movie(name, genre_name, imdb_rating, jayornay, picked_by, participants, is_major)";
				$sql = $sql . "VALUES(:addName,:addGenre,:addIMDB,:addjayornay,:addPickedBy,:addParticipants,:addIs_major);";
				
				$stmp = $conn->prepare($sql);
				$stmp->bindvalue(':addName',$title);
				$stmp->bindvalue(':addGenre',$_POST['addGenre']);
				$stmp->bindvalue(':addIMDB',$grade);
				$stmp->bindvalue(':addjayornay',$_POST['addjayornay']);
				$stmp->bindvalue(':addPickedBy',$_POST['addPickedBy']);
				$stmp->bindvalue(':addParticipants',$_POST['addParticipants']);
				$stmp->bindvalue(':addIs_major',$_POST['addIs_major']);
				
			    if(!$stmp->execute())
			    {
					throw new Exception("unknown error");
			    }

			    if(exists($tempDescription))
			    {
			    	insertDescription($count, $tempDescription);
			    }
			}
			catch(Exception $e)
			{
				echo "<h3> Insert was fucky wucky, insert died</h3>";
				echo "message: " . $e->getMessage();
			}
			try
			{
				$sql = "INSERT INTO movie(name, genre_name, imdb_rating, jayornay, picked_by, participants, is_major)";
				$sql = $sql . "VALUES(:addName,:addGenre,:addIMDB,:addjayornay,:addPickedBy,:addParticipants,:addIs_major);";
				
				$stmp = $conn->prepare($sql);
				$stmp->bindvalue(':addName',$title);
				$stmp->bindvalue(':addGenre',$_POST['addGenre']);
				$stmp->bindvalue(':addIMDB',$grade);
				$stmp->bindvalue(':addjayornay',$_POST['addjayornay']);
				$stmp->bindvalue(':addPickedBy',$_POST['addPickedBy']);
				$stmp->bindvalue(':addParticipants',$_POST['addParticipants']);
				$stmp->bindvalue(':addIs_major',$_POST['addIs_major']);
			}
			catch(Exception $e)
			{

			}
		
			addLog("added movie");

			unset($_POST['addName']);
			unset($_POST['addGenre']);
			unset($_POST['addIMDB']);
			unset($_POST['addjayornay']);
			unset($_POST['addPickedBy']);
			unset($_POST['addParticipants']);
			unset($_POST['addIs_major']);
		}
	}
	catch (Exception $e){
		catchStatent();
	}
}

function insertDescription($count, $description)
{
	$escapedDescription = addcslashes($description, '"\'');
	$conn = GetConnection();
	$sql = "INSERT INTO movieDescription(movieID, cover_path, description)
	VALUES(".$count.", 'C:/xampp/htdocs/Julet/Shared/Images/cover".($count-1).".png', '".$escapedDescription."' )";
	$conn->query($sql);
}

function DeleteMovie()
{
	try{
		$conn = GetConnection();

		$sql = "delete from participated where movieID = :id";
		$stmp = $conn->prepare($sql);
		$stmp->bindvalue(':id',$_POST['deleteId']);
		$stmp->execute();
		$stmp->closeCursor();

		$sql = "delete from movieDescription where movieID = :id";
		$stmp = $conn->prepare($sql);
		$stmp->bindValue(':id',$_POST['deleteId']);
		$stmp->execute();
		$stmp->closeCursor();

		$sql = "delete from movie where id = :id";
		$stmp = $conn->prepare($sql);
		$stmp->bindvalue(':id',$_POST['deleteId']);
		$stmp->execute();
		$stmp->closeCursor();

		//redundency because you can't trust ctype_digit and I don't have the patience to test edge-cases.
		//5 extra steel walls is implemented instead.
		$number = number_format($_POST['deleteId']);
		$number = strval($number-1);
		
		if(!ctype_digit($number) || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-][A-Z][a-z]/', $number))
		{
			throw new Exception("Error Processing Request", 1);
		}
		else
		{
			$file = "Shared/Images/cover".$number.".png";
			if(!unlink($file))
			{
				echo "file was deleted";
			}
			else
			{
				echo "we fuckd boizz, root is gone.";
			}
		}
		addLog("deleted movie");
	}
	catch(Exception $e){
		catchStatent();
	}
}