<?php

//returns true if it exists and is not empty. Saves a bit of space I guess.
function exists($var)
{
  return (isset($var) && !empty($var));
}

//returns true if the username is either root or admin and the login is successful.
function IsAdmin()
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

//returns PDO connection based on the  $_SESSION variables.
function GetConnection()
{
    try
    {
        $conn = new PDO(getConnectionString(), $_SESSION['username'], $_SESSION['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e)
    {
        notLoggedIn();
    }
}

//sorts arrays depending on input type. natsort and natcasesort are used to sort on ASCII value, meaning "filename2.txt" will come before "filename10.txt";
function SortArray($array, $sortType) 
{
	if($sortType == "ascending")
	{
		sort($array);
	}
	else if($sortType == "descending")
	{
		rsort($array);
	}
	else if($sortType == "natural")
	{
		natsort($array);
	}
	else if($sortType == "Case-insensitive")
	{
		natcasesort($array);
	}
  return $array;
}

//sanetizes inputs, should probably be used in most cases.
//Removes php tags, html tags, special characters for SQL injections and extra white space.
//Should be used like $username = sanitizeInput($_POST['username']), etc
function sanitizeInput($input) 
{
  $input = strip_tags($input);
  $input = str_replace(array('<?php', '?>'), '', $input);
  $input = trim($input);
  $input = htmlspecialchars($input, ENT_QUOTES);

  return $input;
}


//big brother WILL be watching
function getClientIP() 
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
	{$ip = $_SERVER['HTTP_CLIENT_IP'];}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
	{$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];} 	
	else
	{$ip = $_SERVER['REMOTE_ADDR'];}

	if ($ip === "::1") 
	{
	    $ip = "127.0.0.1";
	}
	return $ip;
}