</body>
<footer>
	<?php
	if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true)
	{
		?>
		<a class='footerLink' href="../install.php"> Reinstall Database?</a>
		<?php
	}
	else
	{	
		?>
		<h5 style='margin-left: 70vh;'> ©2023 MMH-Group - By browsing this site you allow logging of used credit card PIN-codes </h4>
		<?php
	}
	?>
</footer>