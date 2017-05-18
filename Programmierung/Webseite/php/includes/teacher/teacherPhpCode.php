<?php
	include("db.php");

	$name = $_SESSION['usernameAdmin'];

	if($name == '')
		header('Location: index.php');


	if (isset($_GET['l'])) {
		session_destroy();
		header('Location: index.php');		
	}
?>