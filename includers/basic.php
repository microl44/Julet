<?php
if(!isset($_SESSION))
{session_start();}
require_once(dirname(__FILE__, 2)."/Database.php");

$conn;

enum TableType
{
	case Group;
	case Solo;
	case Marvel;
}

function GetConn()
{
	return DBConn();
}
//returns true if it exists and is not empty. Saves a bit of space I guess.
function exists($var)
{
  return (isset($var) && !empty($var));
}

function RunOnAllPages()
{
	if(exists($_SESSION) && exists($_SERVER))
	{
		$page_url = parse_url($_SERVER['REQUEST_URI']);
		$path = $page_url['path'];
		$page = basename($path);

		$_SESSION['previous_page'] = "hejsan";
	}
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
				addErrorLog($e->getmessage());
			}
		}
	}
	return false;
}

//sorts arrays depending on input type. natsort and natcasesort are used to sort on ASCII value, meaning "filename2.txt" will come before "filename10.txt";
function SortArray($array, $sortType) 
{
	if($sortType == "ASCENDING")
	{
		sort($array);
	}
	else if($sortType == "DESCENDING")
	{
		rsort($array);
	}
	else if($sortType == "NATURAL")
	{
		natsort($array);
	}
	else if($sortType == "CASE_INSENSITIVE")
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

function addLog($activity = 'pageview')
{
	$conn = GetConn();
	if(isset($_SESSION) && isset($_SESSION['username']) && isset($conn))
	{
		$ip = getClientIP();
		$page_url = parse_url($_SERVER['REQUEST_URI']);
		$path = $page_url['path'];
		if($path === "julet")
		{
			$path = "../index.php";
		}
		$page = basename($path);

		$sql = "INSERT INTO activity_log (username, action, data) VALUES(:username, :action, :data)";
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->bindParam(':action', $action, PDO::PARAM_STR);
		$stmt->bindParam(':data', $data, PDO::PARAM_STR);

		$username = sanitizeInput($_SESSION['username']);
		$action = $activity;

		try
		{
		$data = json_encode(array('page_ulr' => $page, 'ip_address' => $ip));
		$stmt->execute();
		}
		catch (Exception $e)
		{
			addErrorLog($e->getmessage());
		}
	}
}

function addErrorLog($message)
{
		$root_dir = getenv('JUL_ROOT');
		$file = fopen($root_dir.'/error_log', 'a+');
		$test = fwrite($file, date("d-m-y H:1:s").": ".$message.PHP_EOL);
		fclose($file);
}
