<?php
class Marvel_movie
{
	private $conn;

	public $id;
	public $participant_id;
	public $participant;
	public $user_rating;
	public $imdb_rating;
	public $movie;
	public $description;
	public $cover_path;

	function __construct($db)
	{
		$conn = $db;
	}

	function __destruct()
	{
		
	}
}
?>