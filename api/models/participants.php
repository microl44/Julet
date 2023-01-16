<?php
class Participant
{
	private $conn;

	public $id;
	public $name;

	function __construct($db)
	{
		$conn = $db;
	}

	function __destruct()
	{

	}
}