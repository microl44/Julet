<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require_once "../includers/basic.php";
	require_once "../loginFunctions.php";
	require_once "../Database.php";
	require_once "../function.php";
	include_once "../includers/header.php";
	
	if(isset($_SESSION['username']) || isset($_SESSION['password']))
	{
		addLog(); ?>
		<div class='content'>
			<div id='chatDiv'>
				<div id='chatDivResponse'>

				</div>
				<div id='chatDivInput'>
					<button id='btnChatInput' onclick="SendMessage()"> SEND </button>
					<input id='chatInput'/>
				</div>
			</div>
		</div>
		<?php include_once "../includers/footer.php";
	}
	else
	{
		//notLoggedIn();
	}
?>

<script type="text/javascript" src="stats.js"></script>