<?php
$dbhost = "localhost";
$dbuser = "micke";
$dbpass = "raspberry";
$db = "Jul";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
