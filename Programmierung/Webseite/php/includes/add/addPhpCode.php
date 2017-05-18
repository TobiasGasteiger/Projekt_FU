<?php
	include("db.php");
	session_start();

	$name = $_SESSION['usernameAdmin'];

	if($name == '')
		header('Location: index.php');


	if (isset($_GET['l'])) {
		session_destroy();
		header('Location: index.php');	
	}

	//KLASSE

	if(isset($_POST["klassehinzufuegen"])){
		global $db;
		$klasseadd = $_POST["klasseadd"];
	
		$sql= $db->prepare("insert into SchoolClass(SchoolClass_Description) VALUES(?)");
		$sql->bind_param("s", $klasseadd);
		
		if($sql->execute()){
			echo "<script type='text/javascript'>alert('Klasse hinzugefügt!');</script>";
		}else{
			echo "<script type='text/javascript'>alert(Fehler - Klasse konnte nicht hinzugefügt werden');</script>";
		}
	}


	 if(isset($_POST["klasseloeschen"])){
		global $db;
		$klassedel = $_POST["klassedel"];
		
		$sql="DELETE FROM SchoolClass WHERE SchoolClass_Description = '$klassedel'";
		if(mysqli_query($db,$sql)){
			echo "<script type='text/javascript'>alert('Klasse gelöscht!');</script>";
		}else{
			print_r($db->error);
			echo "<script type='text/javascript'>alert(Fehler - Klasse konnte nicht gelöscht werden');</script>";
		}
	}
 
	//LEHRER

	if(isset($_POST["lehrerhinzufuegen"])){
		global $db;
		$lehreradd = $_POST["lehreradd"];
		
		$sql= $db->prepare("insert into Teacher(Teacher_Name) VALUES(?)");
		$sql->bind_param("s", $lehreradd);

		if($sql->execute()){
			echo "<script type='text/javascript'>alert('Lehrer hinzugefügt!');</script>";
		}else{
			print_r($db->error);
			echo "<script type='text/javascript'>alert(Fehler - Lehrer konnte nicht hinzugefügt werden');</script>";
		}
	}


	 if(isset($_POST["lehrerloeschen"])){
		global $db;
		$lehrerdel = $_POST["lehrerdel"];
		
		$sql="DELETE FROM Teacher WHERE Teacher_Name = '$lehrerdel'";
		if(mysqli_query($db,$sql)){
			echo "<script type='text/javascript'>alert('Lehrer gelöscht!');</script>";
		}else{
			print_r($db->error);
			echo "<script type='text/javascript'>alert(Fehler - Klasse konnte nicht gelöscht werden');</script>";
		}
	}

	//FAECHER

	if(isset($_POST["fachhinzufuegen"])){
		global $db;
		$fachadd = $_POST["fachadd"];

		$sql= $db->prepare("insert into Subject(Subject_Description) VALUES(?)");
		$sql->bind_param("s", $fachadd);

		if($sql->execute()){
			echo "<script type='text/javascript'>alert('Fach hinzugefügt!');</script>";
		}else{
			print_r($db->error);
			echo "<script type='text/javascript'>alert(Fehler - Fach konnte nicht hinzugefügt werden');</script>";
		}
	}


	 if(isset($_POST["fachloeschen"])){
		global $db;
		$fachdel = $_POST["fachdel"];
		
		$sql="DELETE FROM Subject WHERE Subject_Description = '$fachdel'";
		if(mysqli_query($db,$sql)){
			echo "<script type='text/javascript'>alert('Fach gelöscht!');</script>";
		}else{
			print_r($db->error);
			echo "<script type='text/javascript'>alert(Fehler - Fach konnte nicht gelöscht werden');</script>";
		}
	}
?>