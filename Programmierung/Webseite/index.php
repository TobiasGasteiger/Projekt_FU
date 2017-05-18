<?php
	session_start();
	include("php/includes/index/indexPhpCode.php");
?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>FÜ Projekt - Übersicht</title>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/typeahead.min.js"></script>
		<script src="js/includes/index/indexJsCode.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/liveSearch.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>
	
	<body>
		<nav class="light-blue lighten-1" role="navigation">
			<div class="nav-wrapper container"><a id="logo-container" href="" class="brand-logo">FÜ Verwaltung</a>
				<ul class="right hide-on-med-and-down">
					<li><a href="#loginModal">Login</a></li>
				</ul>

				<ul id="nav-mobile" class="side-nav">
					<li><a href="#loginModal">Login</a></li>
				</ul>
				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
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
										  <input type="text" name="usernameTeacher" class="typeahead2 tt-query" autocomplete="off" spellcheck="false" placeholder="Lehrer">
										  </div>
										</div>
										oder
										<div class='row'>
										  <div class='input-field col s12'>
										  <input type="text" name="usernameAdmin" autocomplete="off" spellcheck="false" placeholder="Admin Benutzer">
										  </div>
										</div>

										<div class='row'>
										  <div class='input-field col s12'>
											<input class='validate' type='password' name='password' id='password' placeholder="Passwort" required/>
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
						<?php include("php/includes/index/indexPhpDynamicTable.php"); ?>
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

		<!--  Scripts-->
		<script src="js/materialize.js"></script>
		<script src="js/init.js"></script>
		<script src="js/includes/index/indexUnten.js"></script>
	</body>
</html>
