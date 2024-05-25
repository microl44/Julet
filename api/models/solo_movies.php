<?php
class Solo_movie
{
	private $conn;

	public $id;
	public $participant_id;
	public $participant;
	public $user_rating;
	public $imdb_rating;
	public $movie;
	public $movie_id;
	public $description;
	public $cover_path;

	function __construct($db)
	{
		$conn = $db;
	}

	function __constructor($id,$participant,$participant_id,$user_rating,$imdb_rating,$movie_id,$description,$cover_path)
	{
		$this->id = $id;
		$this->participant = $participant;
		$this->participant_id = $participant_id;
		$this->user_rating = $user_rating;
		$this->imdb_rating = $imdb_rating;
		$this->movie_id = $movie_id;
		$this->description = $description;
		$this->cover_path = $cover_path;
	}

	function __destruct()
	{

	}
}
?>