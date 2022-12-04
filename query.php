<?php
require_once "loginFunctions.php";
require_once "function.php";
if(exists($_POST['addName']))
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
	try{

		$conn = GetConnection();
		if(isset($_POST['addName']) && isset($_POST['addGenre']) && isset($_POST['addPickedBy']) && isset($_POST['addIs_major']))
		{
			try
			{
				$sql = "INSERT INTO movie(name, genre_name, imdb_rating, jayornay, picked_by, participants, is_major)";
				$sql = $sql . "VALUES(:addName,:addGenre,:addIMDB,:addjayornay,:addPickedBy,:addParticipants,:addIs_major);";
				
				$stmp = $conn->prepare($sql);
				$stmp->bindvalue(':addName',$_POST['addName']);
				$stmp->bindvalue(':addGenre',$_POST['addGenre']);
				$stmp->bindvalue(':addIMDB',$_POST['addIMDB']);
				$stmp->bindvalue(':addjayornay',$_POST['addjayornay']);
				$stmp->bindvalue(':addPickedBy',$_POST['addPickedBy']);
				$stmp->bindvalue(':addParticipants',$_POST['addParticipants']);
				$stmp->bindvalue(':addIs_major',$_POST['addIs_major']);
				
		    if(!$stmp->execute())
		    {
				throw new Exception("unknown error");
		    }
		}
		catch(Exception $e)
		{
			echo "<h3> Insert was fucky wucky, insert died</h3>";
			echo "message: " . $e->getMessage();
		}
		
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

function DeleteMovie()
{
	try{
		$conn = GetConnection();

		$sql = "delete from participated where movieID = :id";
		$stmp = $conn->prepare($sql);
		$stmp->bindvalue(':id',$_POST['deleteId']);
		$stmp->closeCursor();

		$sql = "delete from movie where id = :id";
		$stmp = $conn->prepare($sql);
		$stmp->bindvalue(':id',$_POST['deleteId']);
		$stmp->execute();
	}
	catch(Exception $e){
		catchStatent();
	}
}