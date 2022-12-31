<?php
//PHP GO DIE GO DIE!
$connectionPool = array();

//returns true if it exists and is not empty. Saves a bit of space I guess.
function exists($var)
{
  return (isset($var) && !empty($var));
}

function RunOnAllPages()
{
	$_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
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

//returns PDO connection based on the  $_SESSION variables.
function GetConnection()
{	
	global $connectionCounter;
    try
    {
        $conn = new PDO(getConnectionString(), $_SESSION['username'], $_SESSION['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connectionCounter++;
        echo "current number of threads in circulation" . $connectionCounter;
        return $conn;
    }
    catch(PDOException $e)
    {
        notLoggedIn();
    }
}

function GetConnectionFromPool()
{
	global $connectionPool;
	global $connectionCounter;

	if (!isset($connectionPool)) 
	{
		$connectionPool = array();
	}

	if(count($connectionPool) > 0)
	{
		#echo "CONNECTION FROM THE POOL IS USED";
		return array_shift($connectionPool);
	}
	else
	{
		return GetConnection();
	}
}

function ReturnConnectionToPool($connection)
{
	global $connectionPool;
	$connectionPool[] = $connection;
}

function addLog($activity = 'pageview')
{
	if(exists($_SESSION['username']))
	{
		$conn = GetConnectionFromPool();

		$ip = getClientIP();
		$page_url = parse_url($_SERVER['REQUEST_URI']);
		$path = $page_url['path'];
		$page = basename($path);

		$sql = "INSERT INTO activity_log (username, action, data) VALUES(:username, :action, :data)";
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->bindParam(':action', $action, PDO::PARAM_STR);
		$stmt->bindParam(':data', $data, PDO::PARAM_STR);

		$username = sanitizeInput($_SESSION['username']);
		$action = $activity;

		$data = json_encode(array('page_ulr' => $page, 'ip_address' => $ip));
		$stmt->execute();
		ReturnConnectionToPool($conn);
	}	
}