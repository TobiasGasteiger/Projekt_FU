<?php
	include("db.php");
	session_start();

	if(isset($_SESSION['usernameTeacher'])){
		$name = $_SESSION['usernameTeacher'];
	}

	if(isset($_SESSION['usernameAdmin'])){
		$name = $_SESSION['usernameAdmin'];
	}

	if($name == '')
	header('Location: index.php');

	if (isset($_GET['l'])) {
		session_destroy();
		header('Location: index.php');
	}
?>