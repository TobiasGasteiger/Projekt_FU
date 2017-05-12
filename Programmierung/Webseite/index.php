<?php
	include("db.php");
	session_start();
	
	if(isset($_POST["btnHinzufuegen"])){
	global $db;
	$titel = $_POST["titel"];
	$beschreibung = $_POST["beschreibung"];
	$datum = $_POST["datum"];
	$zusatzpersonen = $_POST["zusatzpersonen"];
	$anfangsstunde = $_POST["anfangsstunde"];
	$endstunde = $_POST["endstunde"];

	
	$sql= $db->prepare("insert into Event(Titel,Description,Date,Person,Begin_Hour,End_Hour) VALUES(?,?,?,?,?,?)");
	$sql->bind_param("ssssii", $titel, $beschreibung, $datum, $zusatzpersonen, $anfangsstunde, $endstunde);
	
	if($sql->execute()){
		echo "<script type='text/javascript'>alert('Daten hinzugefügt!');</script>";
	}else{
		echo "<script type='text/javascript'>alert(Fehler - Daten konnten nicht hinzugefügt werden');</script>";
	}

}

	if(isset($_POST["lehrerhinzufuegen"])){
		global $db;
		$lehreradd = $_POST["lehreradd"];
		
		$sql= $db->prepare("insert into EventwithTeacher(Event_ID, Teacher_Name) VALUES(?, ?)");
		$sql->bind_param("s", $lehreradd);

		if($sql->execute()){
			echo "<script type='text/javascript'>alert('Lehrer hinzugefügt!');</script>";
		}else{
			print_r($db->error);
			echo "<script type='text/javascript'>alert(Fehler - Lehrer konnte nicht hinzugefügt werden');</script>";
		}
	}
	
	if(isset($_POST['klassname']) && isset($_POST['klassesearch'])) {
		$klasse = $_POST['klassesearch'];
		$_SESSION['klasse'] = $klasse;
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
			$('input.typeahead1').typeahead({
				name: 'klassesearch',
				remote:'php/updateKlassen/search.php?key=%QUERY',
				limit : 10
			});
		});
		
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
  <div class="section no-pad-bot" id="index-banner">
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
  <!--Modal Login-->
  
  
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
		<a href="#modal2" class="modal-action waves-effect waves-green btn-flat">Lehrer hinzufügen</a>
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
			
			
			</div>
		</div>
		<div class="modal-footer">	
			<input type="submit" class="modal-action waves-effect waves-light btn-flat" name="btnHinzufuegen" value="OK"></input>
			<input type="submit" class="modal-action waves-effect waves-light btn-flat modal-close" name="btnHinzufuegen" value="Abbrechen"></input>
		</div>
	</form>
  </div>
  
  
  <!-- Modal Unten Lehrer -->
  <div id="modal2" class="modal bottom-sheet">
	<form action="" method="post">
		<div class="modal-content">
		  <h4>Hinzufügen</h4>
		  <div class="row">	
			<div class="input-field col s3">
			  <input type="text" name="klassesearch" class="typeahead2 tt-query" autocomplete="off" spellcheck="false" placeholder="Lehrer suchen" required>
			</div>
			
			<div class="input-field col s3">
				<button type="submit" class='btn btn-large waves-effect indigo'>Los!</button>
			</div>			
			<br><br><br><br><br><br><br><br><br><br><br>
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
		<?php
			date_default_timezone_set("Europe/Rome");
			if(isset($_SESSION['klasse'])){
				$klasse = $_SESSION['klasse'];
				$klasseEvent = $db->query("select * from EventwithSchoolClass natural join Event where SchoolClass_Description = '$klasse';");
				$timetableofClass = $db->query("select SchoolDay, max(SchoolHour) as endHour from Timetable where SchoolClass_Description = '$klasse' group by SchoolDay;");
				
				if(!$klasseEvent)
					die($db->error);
				
				if(!$timetableofClass)
					die($db->error);				
				
				$mo = 0;
				$di = 0;
				$mi = 0;
				$do = 0;
				$fr = 0;
				
				while($row = $klasseEvent->fetch_object()) {
					$datum = $row->Date;
					$weekday = date('l', strtotime($datum));
					if($weekday == "Monday"){
						$montag[$mo] = array(
							"Event_ID" => $row->Event_ID,
							"SchoolClass_Description" => $row->SchoolClass_Description,
							"Titel" => $row->Titel,
							"Description" => $row->Description,
							"Date" => $row->Date,
							"Begin_Hour" => $row->Begin_Hour,
							"End_Hour" => $row->End_Hour,						
						);
						$mo++;
					}
					if($weekday == "Tuesday"){
						$dienstag[$di] = array(
							"Event_ID" => $row->Event_ID,
							"SchoolClass_Description" => $row->SchoolClass_Description,
							"Titel" => $row->Titel,
							"Description" => $row->Description,
							"Date" => $row->Date,
							"Begin_Hour" => $row->Begin_Hour,
							"End_Hour" => $row->End_Hour,						
						);
						$di++;
					}
					if($weekday == "Wednesday"){
						$mittwoch[$mi] = array(
							"Event_ID" => $row->Event_ID,
							"SchoolClass_Description" => $row->SchoolClass_Description,
							"Titel" => $row->Titel,
							"Description" => $row->Description,
							"Date" => $row->Date,
							"Begin_Hour" => $row->Begin_Hour,
							"End_Hour" => $row->End_Hour,						
						);
						$mi++;
					}
					if($weekday == "Thursday"){
						$donnerstag[$do] = array(
							"Event_ID" => $row->Event_ID,
							"SchoolClass_Description" => $row->SchoolClass_Description,
							"Titel" => $row->Titel,
							"Description" => $row->Description,
							"Date" => $row->Date,
							"Begin_Hour" => $row->Begin_Hour,
							"End_Hour" => $row->End_Hour,						
						);
						$do++;
					}
					if($weekday == "Friday"){
						$freitag[$fr] = array(
							"Event_ID" => $row->Event_ID,
							"SchoolClass_Description" => $row->SchoolClass_Description,
							"Titel" => $row->Titel,
							"Description" => $row->Description,
							"Date" => $row->Date,
							"Begin_Hour" => $row->Begin_Hour,
							"End_Hour" => $row->End_Hour,						
						);
						$fr++;
					}
				}				
			}
		
		$stunde = 1;	
		
		while($stunde <= 6) {
			echo"<tr>";			
			
			global $montag;
			global $dienstag;
			global $mittwoch;
			global $donnerstag;
			global $freitag;
						
			addStunde($montag, $stunde, getEventNumbers($montag));
			addStunde($dienstag, $stunde, getEventNumbers($dienstag));
			addStunde($mittwoch, $stunde, getEventNumbers($mittwoch));
			addStunde($donnerstag, $stunde, getEventNumbers($donnerstag));
			addStunde($freitag, $stunde, getEventNumbers($freitag));
			
			echo"</tr>";
			$stunde++;
		}
		
		function getEventNumbers($tag) {
			$eventsProTag = count($tag);
			$j = 0;
			$stundenFU = array();
			while($j < $eventsProTag) {
				$array = $tag[$j];
				$insertHour = 1;
				while($insertHour <= 6) {
					if($insertHour >= $array['Begin_Hour'] && $insertHour <= $array['End_Hour']) {
						$stundenFU[] = $insertHour;
					}	
					$insertHour++;
				}
				$j++;			
			}
			return $stundenFU;
		}
		
		function addStunde($tag, $stunde, $eventsArray) {		
			$eventsProTag = count($tag);
			if($eventsProTag > 0) {
				$i = 0;
				$stundeHatEintrag = array(
					'1' => '0',
					'2' => '0',
					'3' => '0',
					'4' => '0',
					'5' => '0',
					'6' => '0',				
				);
				while($i < $eventsProTag) {
					$array = $tag[$i];
					$begHour = $array['Begin_Hour'];
					$endHour = $array['End_Hour'];
					if($array['Begin_Hour'] <= $stunde && $array['End_Hour'] >= $stunde && in_array($stunde, $eventsArray) && $stundeHatEintrag[$stunde] == '0') {
						$stundeHatEintrag[$stunde] = '1';
						echo "<td><a href='index.php?Titel=$array[Titel]'><a href='#modalOverview'><b>$array[Titel]&nbsp;</b>am $array[Date]</a></a></td>";
					} else if(in_array($stunde, $eventsArray)){ } else if($stundeHatEintrag[$stunde] == '0'){
						echo"<td><a href='#modal1'>Add FÜÜÜ</a></td>";
						$stundeHatEintrag[$stunde] = '1';
					}
					$i++;
				} 				
			} else {
				echo"<td><a href='#modal1'>Add FÜ</a></td>";
			}
		}
		?>
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
      
	$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15,// Creates a dropdown of 15 years to control year
	format: 'yyyy-mm-dd',
	labelMonthNext: 'Nächster Monat',
	labelMonthPrev: 'Letzter Monat',
	labelMonthSelect: 'Monat auswählen',
	labelYearSelect: 'Jahr auswählen',
	monthsFull: [ 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember' ],
	monthsShort: [ 'Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez' ],
	weekdaysFull: [ 'Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag' ],
	weekdaysShort: [ 'Son', 'Mon', 'Die', 'Mit', 'Don', 'Fre', 'Sam' ],
	weekdaysLetter: [ 'S', 'M', 'D', 'M', 'D', 'F', 'S' ],
	today: 'Heute',
	clear: 'Löschen',
	close: 'OK'
  });
       
  
  </script>

  </body>
</html>
