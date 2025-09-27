<?php
function DBConn()
{
	$username = getenv('DB_USERNAME');
	$password = getenv('DB_PASSWORD');
	$conn_string = getenv('DB_CONN');
	try
	{
                $username = 'root';
                $password = '';
		//SET ENV VARIABLES TO LOCAL DATABASE USERNAME & PASSWORD
		//$conn = new PDO($conn_string, $username, $password);
		$conn = new PDO("mysql:host=localhost;dbname=jul;charset=utf8mb4", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $conn;
	}
	catch (Exception $e)
	{
		addErrorLog($e->getmessage());
	}
}
