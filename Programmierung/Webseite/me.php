<?php
include("db.php");
session_start();
$name = $_SESSION['username'];

	if($name == '')
	header('Location: index.php');


  if (isset($_GET['l'])) {
    session_destroy();
	header('Location: index.php');
	
	
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

</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.html" class="brand-logo">FÜ Verwaltung</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="add.php">Daten hinzufügen</a></li>
		<li><a href="lehrer.php">Lehrer Übersicht</a></li>
		<li><a href="me.php">Meine Daten</a></li>
		<li><a href="me.php?l=true">Abmelden</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="add.php">Daten hinzufügen</a></li>
		<li><a href="lehrer.php">Lehrer Übersicht</a></li>
		<li><a href="me.php">Meine Daten</a></li>
		<li><a href="me.php?l=true">Abmelden</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  
  
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
		<center><h4>Meine FÜ Stunden:</h4></center>
		
		
		<?php
			global $db;
			global $name;
				
				$events= $db->query("select * from EventwithTeacher natural join Event natural join EventwithSchoolClass where Teacher_Name LIKE '$name'");
				
				if(!$events)
					die($db->error);
				
				while($zeile= $events->fetch_object()){
					echo"
					<div class='col s12 m6'>
						<div class='card'>
							<div class='card-content'>
								<span class='card-title'>$zeile->Titel</span>
								<p>am $zeile->Date in der Klasse $zeile->SchoolClass_Description.</p>
							</div>
						</div>
					</div>";
						
				}			

				$credit= $db->query("select * from Teacher where Teacher_Name LIKE '$name'");
				$c = $credit->fetch_object();
				echo "
				<br><br><br><br><br><br><br><br><br><br><br><br><br>
				<hr>
				<div class='col s12'>
					<div class='card'>
						<div class='card-content'>
							<span class='card-title'>
								<center><b>Guthaben: $c->Credit</b></center>
							</span>
						</div>
					</div>
				</div>";		
		?>	
		
		
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
