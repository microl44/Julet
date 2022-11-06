
<link type="text/css" href="Shared/style.css" rel="stylesheet">
<script type="text/javascript" src="./Shared/general.js"></script>
<header>
	<div class='navbar'>
		<a href="index.php"> Home </a>
		<a href="stats.php"> Stats </a>
		<?php
		if(isset($_SESSION['username'])){
			echo "<a href='loggout.php'> logg out</a>";
		}
		else{
			include 'login.php';
		}
		?>
	</div>
</header>