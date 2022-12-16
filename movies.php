<?php
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";
	require_once "Javascript/functions.js";
?>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class='content'>
	<form action="movies.php" method="post" name="login-form">
	 <input type="text" name="user" placeholder="Username" required />
	 <input type="password" name="pass" placeholder="Password" required />
	 <input type="submit" name="login" value="Login" />
	</form>
</div>