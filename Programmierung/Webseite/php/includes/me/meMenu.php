<?php
	include("db.php");
			if(isset($_SESSION['usernameTeacher'])){
				
				echo "
					<nav class='light-blue lighten-1' role='navigation'>
						<div class='nav-wrapper container'><a id='logo-container' href='' class='brand-logo'>FÜ Verwaltung</a>
							<ul class='right hide-on-med-and-down'>
								<li><a href='me.php'>Meine Daten</a></li>
								<li><a href='me.php?l=true'>Abmelden</a></li>
							</ul>

							<ul id='nav-mobile' class='side-nav'>
								<li><a href='me.php'>Meine Daten</a></li>
								<li><a href='me.php?l=true'>Abmelden</a></li>
							</ul>
							<a href='#' data-activates='nav-mobile' class='button-collapse'><i class='material-icons'>menu</i></a>
						</div>
					</nav>
				";
			}

			if(isset($_SESSION['usernameAdmin'])){
				
				echo "
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
				";
			}
?>