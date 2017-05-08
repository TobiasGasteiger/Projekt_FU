<?php
#### Einbinden der DB Verbindung ###
include("db.php");


if($_SERVER["REQUEST_METHOD"] == "POST")
{
// Username und Passwort vom Formular
$username=mysqli_real_escape_string($db,$_POST['username']); 
$password=mysqli_real_escape_string($db,$_POST['password']);
$kreditrahmen=mysqli_real_escape_string($db,$_POST['rahmen']); 
$password=md5($password); // Passwort mit MD5 verschlüsseln
$sql="Insert into admin(username,kreditrahmen,passcode) values('$username','$kreditrahmen','$password');";
$result=mysqli_query($db,$sql);
echo "<h3 style='color:green;'>Registration Successfully - <a href='login.php'>Zum Login</a></h3>";
}

?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/typeahead.min.js"></script>
<link href="css/liveSearch.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

<script>
		$(document).ready(function(){
			$('input.typeahead').typeahead({
				name: 'typeahead',
				remote:'php/updateLehrer/search.php?key=%QUERY',
				limit : 10
			});
		});
</script>



</head>
<body>
<center>
<div id="alles">
<form action="createUser.php" method="post">

	<h3>create User</h3>
	<div class="container">
	<div class="row">
		<div class="col s3">

				<input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Namen eingeben">

				<input type="password" name="password" width="10" placeholder="Passwort setzen"/><br/>

				<input type="submit" value=" Benutzer erstellen "/><br />

		</div>
	</div>
	</div>
</form>
</center>
</div>