<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "loginFunctions.php";
	require_once "Database.php";
	require_once "includers/header.php";

	if(isset($_SESSION['username']) || isset($_SESSION['password']))
	{?>
		<div id='rulesDiv'>
			
		</div>
		<?php
		include_once("includers/footer.php");
	}
	else
	{
		notLoggedIn();
	}
?>
</body>