<?php
function isAdmin()
{
	if ($_SESSION['username'] == "root" || "admin" AND isset($_SESSION['password']))
	{
		foreach(["root", "admin"] as $username)
		{
			try
			{
				$loginAttempt = new PDO("mysql:host=localhost;dbname=Jul", $username, $_SESSION['password']);
				return true;
			}
			catch(PDOException $e)
			{
				continue;
			}
		}
	}
	return false;
}