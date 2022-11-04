<?php
	$username = "root";
	$password = "tinytiger997";

	$conn = new PDO("mysql:dbname=jul;host=localhost;port=3307", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
