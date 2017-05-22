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
		$klasse = $_SESSION["klasse"];
		$titel = $_POST["titel"];
		$beschreibung = $_POST["beschreibung"];
		$datum = $_POST["datum"];
		$zusatzpersonen = $_POST["zusatzpersonen"];
		$anfangsstunde = $_POST["anfangsstunde"];
		$endstunde = $_POST["endstunde"];
		//$lehrer = $_POST["lehrer"];
		$lehrer = array();
		$lehrer[] = "Abrim Elda";
		$lehrer[] = "Alper Thomas";

		$sql= $db->prepare("insert into Event(Titel,Description,Date,Person,Begin_Hour,End_Hour) VALUES(?,?,?,?,?,?)");
		$sql->bind_param("ssssii", $titel, $beschreibung, $datum, $zusatzpersonen, $anfangsstunde, $endstunde);

		if($sql->execute()){
			$eventID = $sql->insert_id;
			
			$i = 0;
			while($i < count($lehrer)) {
				$sql3 = $db->prepare("insert into EventwithTeacher(Event_ID, Teacher_Name) VALUES (?,?);");
				$sql3->bind_param("is", $eventID, $lehrer[$i]);
				if($sql3->execute()) {}
				else {
					echo "<script type='text/javascript'>alert(Fehler - Daten konnten nicht hinzugefügt werden');</script>";
				}
				$sql3->close();
				$i++;
			}
			
			$sql2 = $db->prepare("insert into EventwithSchoolClass(Event_ID, SchoolClass_Description) VALUES (?,?);");
			$sql2->bind_param("is", $eventID, $klasse);
			if($sql2->execute()) {								
				echo "<script type='text/javascript'>alert('Daten hinzugefügt!');</script>";
			}else{
				echo "<script type='text/javascript'>alert(Fehler - Daten konnten nicht hinzugefügt werden');</script>";
			}
		}else{
			echo "<script type='text/javascript'>alert(Fehler - Daten konnten nicht hinzugefügt werden');</script>";
		}		
	}

	if(isset($_POST['klassname']) && isset($_POST['klassesearch'])) {
		$klasse = $_POST['klassesearch'];
		$_SESSION['klasse'] = $klasse;
	}
?>