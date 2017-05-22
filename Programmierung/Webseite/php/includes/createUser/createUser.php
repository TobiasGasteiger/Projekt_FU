<?php
#### Einbinden der DB Verbindung ###
include("db.php");
session_start();

$name = $_SESSION['usernameAdmin'];

if($name == '')
	header('Location: index.php');


if (isset($_GET['l'])) {
	session_destroy();
	header('Location: index.php');	
}

if(isset($_POST["btnSetPassword"])){
// Username und Passwort vom Formular
$username=mysqli_real_escape_string($db,$_POST['username']); 
$password=mysqli_real_escape_string($db,$_POST['password']);
$password=md5($password); // Passwort mit MD5 verschlüsseln
$sql = "UPDATE Teacher SET Password = '$password' WHERE Teacher_Name = '$username';";
$result=mysqli_query($db,$sql);
echo "<h3 style='color:green;'>Passwort erfolgreich gesetzt</h3>";
}

if(isset($_POST["btnCreateAdmin"])){
// Username und Passwort vom Formular
$username=mysqli_real_escape_string($db,$_POST['username']); 
$password=mysqli_real_escape_string($db,$_POST['password']);
$password=md5($password); // Passwort mit MD5 verschlüsseln
$sql = "insert into Admin VALUES ('$username', '$password')";
$result=mysqli_query($db,$sql);
echo "<h3 style='color:green;'>Admin erfolgreich erstellt</h3>";
}


?>