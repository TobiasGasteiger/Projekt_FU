<?php
	include("php/includes/add/addPhpCode.php");
?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>FÜ Projekt - Daten hinzufügen</title>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/typeahead.min.js"></script>
		<script src="js/includes/add/addJsCode.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/liveSearch.css" type="text/css" rel="stylesheet" media="screen,projection"/>	
	</head>
	
	<body>
		<nav class='light-blue lighten-1' role='navigation'>
			<div class='nav-wrapper container'><a id='logo-container' href='index.php' class='brand-logo'>FÜ Verwaltung</a>
				<ul class='right hide-on-med-and-down'>
					<li><a href='indexAdmin.php'>Plan verwalten</a></li>
					<li><a href='createUser.php'>Benutzer hinzufügen</a></li>
					<li><a href='add.php'>Daten hinzufügen</a></li>
					<li><a href='teacher.php'>Lehrer Übersicht</a></li>
					<li><a href='me.php?l=true'>Abmelden</a></li>
				</ul>

				<ul id='nav-mobile' class='side-nav'>
					<li><a href='indexAdmin.php'>Plan verwalten</a></li>
					<li><a href='createUser.php'>Benutzer hinzufügen</a></li>
					<li><a href='add.php'>Daten hinzufügen</a></li>
					<li><a href='teacher.php'>Lehrer Übersicht</a></li>
					<li><a href='me.php?l=true'>Abmelden</a></li>
				</ul>
				<a href='#' data-activates='nav-mobile' class='button-collapse'><i class='material-icons'>menu</i></a>
			</div>
		</nav>
		
		<div class="section no-pad-bot" id="index-banner" style="background-color: #cfd8dc;">
			<div class="container">
			  <!-- Modal Login -->
				<div id="loginModal" class="modal">
					<div class="modal-content">
						<h4><center>Login</center></h4>
						<div class="section"></div>
						<div class="container">
							<div>
								<form class="col s12" method="post">
									<div class='row'>
										<div class='input-field col s12'>
											<input class='validate' type='email' name='email' id='email' />
											<label for='email'>Enter your email</label>
										</div>
									</div>

									<div class='row'>
										<div class='input-field col s12'>
											<input class='validate' type='password' name='password' id='password' />
											<label for='password'>Enter your password</label>
										</div>
										<label style='float: right;'>
											<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
										</label>
									</div>
									<br />
									<div class='row'>
										<button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
					</div>
				</div>
  
				<h4>Update</h4>
				
				<div class="row">
					<div class="col s12 m12">
						<div class="card">
							<div class="card-content">
								<span class="card-title">Klassen</span>
								<form action="" method="post">
									<div class="row">
										<div class="input-field col s6">
											<i class="material-icons prefix">view_list</i>
											<input id="first_name" name="klasseadd" type="text" class="validate">
											<label for="first_name">Klasse hinzufügen</label>	
										</div>
										
										<div class="input-field col s6">
											<center>
											<input type="submit" class="waves-effect waves-light btn" name="klassehinzufuegen" value="Hinzufügen"></input>
											</center>
										</div>
									</div>
							
									<div class="row">	
										<div class="input-field col s6">
											<input type="text" name="klassedel" class="typeahead1 tt-query" autocomplete="off" spellcheck="false" placeholder="Klasse suchen">
										</div>
										
										<div class="input-field col s6">
											<center>
											<input type="submit" class="waves-effect waves-light btn" name="klasseloeschen" value="Löschen"></input>
											</center>
										</div>
									 </div>
								</form>
							</div>
						</div>
					</div>
				</div>
	
				<div class="row">
					<div class="col s12 m12">
						<div class="card">
							<div class="card-content">
								<span class="card-title">Lehrer</span>
								<form action="" method="post">
									<div class="row">
										<div class="input-field col s6">
											<i class="material-icons prefix">view_list</i>
											<input id="first_name" name="lehreradd" type="text" class="validate">
											<label for="first_name">Lehrer hinzufügen (Nachname, Vorname)</label>	
										</div>
										
										<div class="input-field col s6">
											<center>
											<input type="submit" class="waves-effect waves-light btn" name="lehrerhinzufuegen" value="Hinzufügen"></input>
											</center>
										</div>
									</div>
									<div class="row">	
										<div class="input-field col s6">
											<input type="text" name="lehrerdel" class="typeahead2 tt-query" autocomplete="off" spellcheck="false" placeholder="Lehrer suchen">
										</div>
										
										<div class="input-field col s6">
											<center>
											<input type="submit" class="waves-effect waves-light btn" name="lehrerloeschen" value="Löschen"></input>
											</center>
										</div>
									 </div>
								</form>
							</div>
						</div>
					</div>
				</div>
	
				<div class="row">
					<div class="col s12 m12">
						<div class="card">
							<div class="card-content">
								<span class="card-title">Fächer</span>
								<form action="" method="post">
									<div class="row">
										<div class="input-field col s6">
											<i class="material-icons prefix">view_list</i>
											<input id="first_name" name="fachadd" type="text" class="validate">
											<label for="first_name">Fach hinzufügen</label>
										</div>
										
										<div class="input-field col s6">
											<center>
											<input type="submit" class="waves-effect waves-light btn" name="fachhinzufuegen" value="Hinzufügen"></input>
											</center>
										</div>
									</div>
									<div class="row">	
										<div class="input-field col s6">
											<input type="text" name="fachedel" class="typeahead3 tt-query" autocomplete="off" spellcheck="false" placeholder="Fach suchen">
										</div>
										
										<div class="input-field col s6">
											<center>
											<input type="submit" class="waves-effect waves-light btn" name="fachloeschen" value="Löschen"></input>
											</center>
										</div>
									 </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div> 
         
		<footer class="page-footer">
			<div class="footer-copyright light-blue lighten-1">
				<div class="container">
					© 2017 Klasse 5BT (2016/17)
					<a class="grey-text text-lighten-4 right" onclick="Materialize.toast('Sie besitzen die Version v1.0', 4000)">Version</a>
				</div>
			</div>
		</footer>
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>
	</body>
</html>
