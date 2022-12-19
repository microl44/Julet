<?php
	session_start();
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";

if(isset($_SESSION['username']) || isset($_SESSION['password']))
{?>