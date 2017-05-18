<?php
	include("db.php");
	
	$name = $_SESSION['usernameAdmin'];

	if($name == '')
		header('Location: index.php');


	if (isset($_GET['l'])) {
		session_destroy();
		header('Location: index.php');	
	}
  
	if(isset($_POST["btnHinzufuegen"])){
		global $db;
		$titel = $_POST["titel"];
		$beschreibung = $_POST["beschreibung"];
		$datum = $_POST["datum"];
		$zusatzpersonen = $_POST["zusatzpersonen"];
		$anfangsstunde = $_POST["anfangsstunde"];
		$endstunde = $_POST["endstunde"];

	
		$sql= $db->prepare("insert into Event(Titel,Description,Date,Person,Begin_Hour,End_Hour) VALUES(?,?,?,?,?,?)");
		$sql->bind_param("ssssii", $titel, $beschreibung, $datum, $zusatzpersonen, $anfangsstunde, $endstunde);
	
		if($sql->execute()){
			echo "<script type='text/javascript'>alert('Daten hinzugefügt!');</script>";
		}else{
			echo "<script type='text/javascript'>alert(Fehler - Daten konnten nicht hinzugefügt werden');</script>";
		}
	}

	if(isset($_POST['klassname']) && isset($_POST['klassesearch'])) {
		$klasse = $_POST['klassesearch'];
		$_SESSION['klasse'] = $klasse;
	}
?>