<?php
define('DB_SERVER', 'linuxserver');
define('DB_USERNAME', 'ststeraf');
define('DB_PASSWORD', 'mypass');
define('DB_DATABASE', 'projekt_fu');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>


<!DOCTYPE html>
<html lang="en">
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
			$('input.typeahead').typeahead({
				name: 'typeahead',
				remote:'php/searchLehrer/search.php?key=%QUERY',
				limit : 10
			});
		});
    </script>
	</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.html" class="brand-logo">FÜ Verwaltung</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="add.php">Daten hinzufügen</a></li>
		<li><a href="lehrer.html">Lehrer Übersicht</a></li>
		<li><a href="#">Abmelden</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="add.php">Daten hinzufügen</a></li>
		<li><a href="lehrer.html">Lehrer Übersicht</a></li>
		<li><a href="#">Abmelden</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  
  
  <div class="container">
  <!-- Modal login -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <h4><center>Login</center></h4>
		  <div class="section"></div>

		  <div class="container">
			<div >

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
  
    <div class="row">
	<div class="col s12">
		<div class="input-field">
			<form action="" method="post">
			<h5>Lehrer suchen: </h5><input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Namen eingeben">
			<button type="submit" class='btn btn-large waves-effect indigo'>Los!</button>
			</form>
		</div>
    </div>
	</div>
  
  	 
	<div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <span class="card-title">
				  <?php
					global $db;
					$lehrer = $_POST['typeahead'];
					echo "<center>";
					$erg= $db->query("select * from Teacher where Teacher_Name LIKE '$lehrer'");
					echo "<script>document.getElementById('lehrer').value</script>";
						
					while($zeile= $erg->fetch_object()){
						echo "<pre>";
						print_r($zeile->Teacher_Name); echo "<br>";
						echo "</pre>";		
					}	
				?>  
			 </span>
              <p>Eventuelle Informationen über den Lehrer</p>
            </div>
          </div>
        </div>
		<center><h4>FÜ Stunden:</h4></center>
		
		<div class="col s12 m6">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Kochen</span>
              <p>am 14.03.2017 in der Klasse 4BT</p>
            </div>
          </div>
        </div>
		
		<div class="col s12 m6">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Singen</span>
              <p>am 04.02.2017 in der Klasse 3AT</p>
            </div>
          </div>
        </div>
		
		<div class="col s12 m6">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Singen</span>
              <p>am 04.02.2017 in der Klasse 3AT</p>
            </div>
          </div>
        </div>
		
		<div class="col s12 m6">
          <div class="card">
            <div class="card-content">
              <span class="card-title">Singen</span>
              <p>am 04.02.2017 in der Klasse 3AT</p>
            </div>
          </div>
        </div>
		
		<div class="col s12 m3">
          <div class="card">
            <div class="card-content">
              <span class="card-title"><b>Guthaben: +4</b></span>
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
