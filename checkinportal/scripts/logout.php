<?php
	session_start();
	session_destroy();
	$welcome_page="../index.php";
	header("Location:$welcome_page", TRUE);
?>