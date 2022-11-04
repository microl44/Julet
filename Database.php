<?php
	$username = "root";
	$password = "";

	$conn = new PDO("mysql:dbname=jul;host=localhost;port=3306", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!-- REEEEE -->