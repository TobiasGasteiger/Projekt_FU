<?php
	include("php/includes/me/mePhpCode.php");
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	  
		<title>FÜ Projekt - Meine Stunden</title>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/typeahead.min.js"></script>
		<script src="js/includes/me/meJsCode.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>
	
	<body>
		<?php include("php/includes/me/meMenu.php"); ?>

		<div class="container"> 
			<div class="row">
				<div class="col s12">
				  <div class="card">
					<div class="card-content">
					  <span class="card-title"><?php echo $name; ?></span>
					  <p>Eventuelle Informationen über den Lehrer</p>
					</div>
				  </div>
				</div>
				<center>
					<h4>Meine FÜ Stunden:</h4>
				</center>				
				<?php include("php/includes/me/meTeacherOverview.php"); ?>	
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
		<script>  
			$(document).ready(function(){
				$('.modal').modal();
			});
		  
			$(document).ready(function(){
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
