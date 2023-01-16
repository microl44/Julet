<?php
class Genre
{
	private $conn;

	public $name;

	function __construct($db)
	{
		$conn = $db;
	}

	function __destruct()
	{

	}
}