<?php
class Group_movie
{
	private $conn;

	public $id;
	public $participant_id;
	public $participant;
	public $genre;
	public $picked_by;
	public $movie;
	public $imdb_rating;
	public $description;
	public $jayornay;
	public $is_mayor;
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