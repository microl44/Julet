<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "../includers/basic.php";
	require_once "../loginFunctions.php";
	require_once "../Database.php";
	require_once "../includers/header.php";
	
	if(isset($_SESSION['username']) || isset($_SESSION['password']))
	{
		addLog(); ?>
		<div class="content">
			<script type="text/javascript" src="../Javascript/julMS.js"></script>
		</div>
	<?php
		include_once("../includers/footer.php");
	}
	else
	{
		notLoggedIn();
	}
?>
</body>