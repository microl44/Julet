<?php
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "function.php";
	require_once "includers/header.php";
	require_once "Javascript/functions.js";
?>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class='content'>
	<div class="login-form">
		<form method="post" onsubmit="loginFunction()">
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" />

			<label for="password">Password:</label>
			<input type="password" name="password" id="password" />

			<input type="submit" value="Login" />
		</form>
	</div>
</div>