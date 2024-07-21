<?php
function DBConn()
{
	$username = getenv('DB_USERNAME');
	$password = getenv('DB_PASSWORD');
	$conn_string = getenv('DB_CONN');
	try
	{
		//SET ENV VARIABLES TO LOCAL DATABASE USERNAME & PASSWORD
		$conn = new PDO($conn_string, $username, $password);
		return $conn;
	}
	catch (Exception $e)
	{
		echo $username;
		echo '<br/>';
		echo $password;
		echo '<br/>';
		echo $conn_string;
		echo '<br/>';
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}
