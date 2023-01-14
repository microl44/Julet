<?php
class Movie
{
	private $conn;

	public $id;
	public $name;
	public $genre;
	public $rating;
	public $jayornay;
	public $picker;
	public $participants;
	public $type;

	function __construct($db)
	{
		$conn = $db;
	}

	function __destruct()
	{

	}

	function Read()
	{

	}
}