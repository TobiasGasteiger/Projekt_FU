<?php
	session_start();
	include("php/includes/indexAdmin/indexAdminPhpCode.php");
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>FÜ Projekt - Admin Übersicht</title>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/typeahead.min.js"></script>
		<script src="js/includes/indexAdmin/indexAdminJsCode.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/liveSearch.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>
	
	<body>
		<nav class='light-blue lighten-1' role='navigation'>
			<div class='nav-wrapper container'><a id='logo-container' href='' class='brand-logo'>FÜ Verwaltung</a>
				<ul class='right hide-on-med-and-down'>
					<li><a href='add.php'>Daten hinzufügen</a></li>
					<li><a href='teacher.php'>Lehrer Übersicht</a></li>
					<li><a href='me.php?l=true'>Abmelden</a></li>
				</ul>

				<ul id='nav-mobile' class='side-nav'>
					<li><a href='add.php'>Daten hinzufügen</a></li>
					<li><a href='teacher.php'>Lehrer Übersicht</a></li>
					<li><a href='me.php?l=true'>Abmelden</a></li>
				</ul>
				<a href='#' data-activates='nav-mobile' class='button-collapse'><i class='material-icons'>menu</i></a>
			</div>
		</nav>
		
		<div class="section no-pad-bot" id="index-banner">
			<div class="container">
				<!-- Modal login -->
				<div id="loginModal" class="modal">
					<div class="modal-content">
						<h4><center>Login</center></h4>
						  <div class="section"></div>
							<div class="container">
								<div>
									<form class="col s12" action="" method="post">
										<div class='row'>
										  <div class='input-field col s12'>
										  <input type="text" name="username" class="typeahead2 tt-query" autocomplete="off" spellcheck="false" placeholder="Lehrer suchen">
										  </div>
										</div>

										<div class='row'>
										  <div class='input-field col s12'>
											<input class='validate' type='password' name='password' id='password' placeholder="Passwort"/>
										  </div>
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
	  
					<!-- Modal Preview -->
					<div id="modalOverview" class="modal">
						<div class="modal-content">
						  <h4>Montag 1. Stunde</h4>
						  <p>Lehrpersonen: ...</p>
						  <p>Thema: Kochen</p>
						  <p>Infos: ...</p>
						</div>
						<div class="modal-footer">
							<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
							<a href="#modal1" class="modal-action waves-effect waves-green btn-flat">EDIT</a>
						</div>
					</div>
	  
	  
				   <!-- Modal Unten FU Stunde-->
					<div id="modal1" class="modal bottom-sheet">
						<form action="" method="post">
							<div class="modal-content">
								<h4>Hinzufügen</h4>
								<div class="row">
									<div class="input-field col s6">
										<input id="first_name" type="text" name="titel" class="validate" required>
										<label for="first_name">Titel *</label>
									</div>
								
									<div class="input-field col s6">
										<input id="first_name" type="text" name="beschreibung" class="validate">
										<label for="first_name">Beschreibung</label>
									</div>
								
									<div class="input-field col s6">
										<input type="date" class="datepicker" name="datum" required>
										<label for="first_name">Datum *</label>
									</div>
								
									<div class="input-field col s6">
										<input id="first_name" type="text" name="zusatzpersonen" class="validate">
										<label for="first_name">Zusatzpersonen</label>
									</div>	
								
									<div class="input-field col s6">
										<input id="first_name" type="text" name="anfangsstunde" class="validate" required>
										<label for="first_name">Anfangsstunde *</label>
									</div>
								
									<div class="input-field col s6">
										<input id="first_name" type="text" name="endstunde" class="validate" required>
										<label for="first_name">Endstunde *</label>
									</div>	

									<div class="input-field col s3">
										<input type="text" name="lehrername" class="typeahead2 tt-query" autocomplete="off" spellcheck="false" placeholder="Lehrer suchen" required>
									</div>
								
									<div class="input-field col s3">
										<button type="submit" name="btnLehrerHinzufuegen" class='btn btn-large waves-effect indigo'>Los!</button>
									</div>
								</div>
							</div>
							
							<div class="modal-footer">	
								<input type="submit" class="modal-action waves-effect waves-light btn-flat" name="btnHinzufuegen" value="OK"></input>
								<input type="submit" class="modal-action waves-effect waves-light btn-flat modal-close" name="btnHinzufuegen" value="Abbrechen"></input>
							</div>
						</form>
					</div>
	 
					<div class="row">
						<div class="input-field col s6">
							<form action="" method="post">
								<input type="text" name="klassesearch" class="typeahead1 tt-query" autocomplete="off" spellcheck="false" placeholder="Klasse suchen">
								<button type="submit" name="klassname" class='btn btn-large waves-effect indigo'>Los!</button>
							</form>
						</div>
					 </div>
		  
					<table class="bordered responsive-table">
						<thead>
							<tr>
								<td>Montag</td>
								<td>Dienstag</td>
								<td>Mittwoch</td>
								<td>Donnerstag</td>
								<td>Freitag</td>
							</tr>
						</thead>

						<tbody>
							<?php include("php/includes/indexAdmin/indexAdminDynamicTable.php"); ?>
						</tbody>
					</table>
			</div>
		</div>
		<br><br>
	  
		<footer class="page-footer white">
			<div class="footer-copyright light-blue lighten-1">
				<div class="container">
					© 2017 Klasse 5BT (2016/17)
					<a class="grey-text text-lighten-4 right" onclick="Materialize.toast('Sie besitzen die Version 0.1', 4000)">Version</a>
				</div>
			 </div>
		</footer>

		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>
		<script src="js/includes/indexAdmin/indexAdminUnten.js"></script>
	</body>
</html>
