<?php
#### Einbinden der DB Verbindung ###
include("db.php");


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

<!DOCTYPE html>
<html lang="de">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="js/typeahead.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/liveSearch.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
    <script>		
		$(document).ready(function(){
			$('input.typeahead2').typeahead({
				name: 'lehrerdel',
				remote:'php/updateLehrer/search.php?key=%QUERY',
				limit : 10
			});
		});
    </script>
	
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.html" class="brand-logo">FÜ Verwaltung</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#loginModal">Login</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#loginModal">Login</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
 <h4><center>Lehrer Passwort setzen</center></h4>

	
	<div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Lehrer</span>
				<form action="" method="post">
				
					<div class="row">	
						<div class="input-field col s6">
							<input type="text" name="username" class="typeahead2 tt-query" autocomplete="off" spellcheck="false" placeholder="Lehrer suchen">
						</div>
					</div>
					
					<div class="row">
						<div class="input-field col s6">
							<input id="first_name" name="password" type="password" class="validate" placeholder="Password">
						</div>	
					</div>
					
					<div class="row">
						<div class="input-field col s12">
							<button type='submit' name="btnSetPassword" class='col s12 btn btn-large waves-effect indigo'>Passwort Setzen</button>
						</div>	
					</div>	
				</form>
            </div>
          </div>
        </div>
    </div> 
 </div> 

 <h4><center>Admin Benutzer erstellen</center></h4>

	
	<div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Admin</span>
				<form action="" method="post">
				
					<div class="row">	
						<div class="input-field col s6">
							<input name="username" type="text" class="validate" placeholder="Benutzername">
						</div>
					</div>
					
					<div class="row">
						<div class="input-field col s6">
							<input name="password" type="password" class="validate" placeholder="Password">
						</div>	
					</div>
					
					<div class="row">
						<div class="input-field col s12">
							<button type='submit' name="btnCreateAdmin" class='col s12 btn btn-large waves-effect indigo'>Erstellen</button>
						</div>	
					</div>				
				</form>
            </div>
          </div>
        </div>
    </div> 
 </div> 
 
<footer class="page-footer white">

          <div class="footer-copyright light-blue lighten-1">
            <div class="container">
            © 2017 Klasse 5BT (2016/17)
            <a class="grey-text text-lighten-4 right" onclick="Materialize.toast('Sie besitzen die Version 0.1', 4000)">Version</a>
            </div>
          </div>
</footer>
  <!--  Scripts-->
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script>  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
  
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
  
  
  $(document).ready(function() {
    $('select').material_select();
  });
  
    $(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });
      
  
  </script>

  </body>
</html>
