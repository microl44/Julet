<?php 
if(!isset($_SESSION))
{
	session_start();
}
require_once "includers/basic.php";


function addLog($activity = 'pageview')
{
	if(exists($_SESSION['consent'] && $_SESSION['consent'] == True))
	{
		if(exists($_SESSION['username']))
		{
			$conn = GetConnection();

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
		}	
	}
}


?>