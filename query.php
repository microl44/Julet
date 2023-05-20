<?php
require_once "loginFunctions.php";
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




function insertDescription($count, $description)
{
	$escapedDescription = addcslashes($description, '"\'');
	$conn = GetConnection();
	$sql = "INSERT INTO movieDescription(movieID, cover_path, description)
	VALUES(".$count.", 'C:/xampp/htdocs/Julet/Shared/Images/cover".($count-1).".png', '".$escapedDescription."' )";
	$conn->query($sql);
}

function getDescription($movieID)
{
	
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

		$sql = "delete from movie where id = :id";
		$stmp = $conn->prepare($sql);
		$stmp->bindvalue(':id',$_POST['deleteId']);
		$stmp->execute();
	}
	catch(Exception $e){
		catchStatent();
	}
}