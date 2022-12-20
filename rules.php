<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";

echo "<div class='content'>";
if(isset($_SESSION['username']) || isset($_SESSION['password']))
{
	
}
else
{
	notLoggedIn();
}
echo "</div>";
include_once("includers/footer.php");

?>
