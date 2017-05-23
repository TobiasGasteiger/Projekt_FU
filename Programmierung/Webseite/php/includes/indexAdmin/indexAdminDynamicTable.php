<?php
	include("db.php");
	date_default_timezone_set("Europe/Rome");

	if(isset($_SESSION['klasse'])){
		$klasse = mysqli_real_escape_string($db,$_SESSION['klasse']);
		$klasseEvent = $db->query("select * from EventwithSchoolClass natural join Event where SchoolClass_Description = '$klasse';");
		$timetableofClass = $db->query("select SchoolDay, max(SchoolHour) as endHour from Timetable where SchoolClass_Description = '$klasse' group by SchoolDay;");
		
		if(!$klasseEvent)
			die($db->error);
			
		if(!$timetableofClass)
			die($db->error);

		$i = 0;
		//Array erstellen wieviele Stunden pro Tag sind		
		while($classEndHour = $timetableofClass->fetch_object()) {
			$isSchool[$i] =  $classEndHour->endHour;
			$i++;
		}
		
		$mo = 0;
		$di = 0;
		$mi = 0;
		$do = 0;
		$fr = 0;
		
		//Array für jeden Tag. Dieser bekommt die Events die an diesem Tag sind
		while($row = $klasseEvent->fetch_object()) {
			createModalforEvent($row);
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
	
	//Dynamische Tabelle wird generiert
	while($stunde <= 9) {
		echo"<tr>";			
		
		global $montag;
		global $dienstag;
		global $mittwoch;
		global $donnerstag;
		global $freitag;
		global $isSchool;	

		addStunde($montag, $stunde, getEventNumbers($montag), $isSchool[0]);
		addStunde($dienstag, $stunde, getEventNumbers($dienstag), $isSchool[1]);
		addStunde($mittwoch, $stunde, getEventNumbers($mittwoch), $isSchool[2]);
		addStunde($donnerstag, $stunde, getEventNumbers($donnerstag), $isSchool[3]);
		addStunde($freitag, $stunde, getEventNumbers($freitag), $isSchool[4]);
		
		echo"</tr>";
		$stunde++;
	}
	
	//Speichert jedes Event des dementsprechenden Tages in ein Array
	function getEventNumbers($tag) {
		$eventsProTag = count($tag);
		$j = 0;
		$stundenFU = array();
		while($j < $eventsProTag) {
			$array = $tag[$j];
			$insertHour = 1;
			while($insertHour <= 9) {
				if($insertHour >= $array['Begin_Hour'] && $insertHour <= $array['End_Hour']) {
					$stundenFU[] = $insertHour;
				}	
				$insertHour++;
			}
			$j++;			
		}
		return $stundenFU;
	}
	
	//Fügt jede einzelne Stunde ein, FÜ, AddFÜ oder nichts (wenn kein Unterricht ist)
	function addStunde($tag, $stunde, $eventsArray, $isSchool) {		
		$eventsProTag = count($tag);
		
		//Array Stunde hat einen Eintrag erstellen, zu Beginn jede Stunde 0, falls etwas eingetragen wird (FÜ oder AddFÜ) dann 1, 3 steht für keine Schule
		$j = 0;
			
		while($j < 9){
			$j++;
			if($j <= $isSchool) {
				$stundeHatEintrag[$j] = '0';
			} else {
				$stundeHatEintrag[$j] = '3';
			}
		}
		
		//Wenn an einem Tag Events sind
		if($eventsProTag > 0 && $isSchool >= $stunde) {
			$i = 0;
			//solange an einem Tag Events sind
			while($i < $eventsProTag) {
				$array = $tag[$i];
				$begHour = $array['Begin_Hour'];
				$endHour = $array['End_Hour'];
				//Es ist zu jetztigen Stunde FÜ
				if($array['Begin_Hour'] <= $stunde && $array['End_Hour'] >= $stunde && in_array($stunde, $eventsArray) && $stundeHatEintrag[$stunde] == '0') {
					$stundeHatEintrag[$stunde] = '1';
					echo "<td><a href='#modalEvent$array[Event_ID]' id='$array[Event_ID]')><b>$array[Titel]&nbsp;</b>am $array[Date]</a></td>";
				//Es ist zu jetztigen kein FÜ, aber Unterricht
				} else if($stundeHatEintrag[$stunde] == '0' && $isSchool >= $stunde){
					echo"<td><a href='#modalAdd'>Add FÜ</a></td>";
					$stundeHatEintrag[$stunde] = '1';
				}
				$i++;
			} 	
		//Wenn einem Tag keine Events sind aber Schule ist
		} else if($isSchool >= $stunde && $stundeHatEintrag[$stunde] == '0'){
			echo"<td><a href='#modalAdd'>Add FÜ</a></td>";
			$stundeHatEintrag[$stunde] = '1';
		//Wenn keine Schule ist
		} else if($isSchool < $stunde){
			echo"<td><a href='#modalAdd'>&nbsp;</a></td>";
			$stundeHatEintrag[$stunde] = '1';
		}
	}
	
	//Diese Funktion erstell dynamisch die Modals für jedes Event, mit den jeweilig richtigen Funktionen
	function createModalforEvent($row) {
		//Die beteiligten Lehrer für das jeweilige Event laden
		include("db.php");
		$lehrer = $db->query("select Teacher_Name from Event natural join EventwithTeacher where Event_ID = $row->Event_ID;");
		$db->close();
		//Modal beginnen
		$modal = 
		"<div id='modalEvent$row->Event_ID' class='modal'>
			<div class='modal-content'>
			  <h4>$row->Titel</h4>";
		//Wenn es einge Beschreibung gibt einfügen
		if ($row->Description != null || $row->Description != ""){
			$modal .= "<p>Beschreibung: $row->Description</p>";
		}
		//Datum einfügen
		$modal .= "<p>Datum: $row->Date in der $row->Begin_Hour - $row->End_Hour Stunde</p>";	
		//Lehrer einfügen
		$modal .= "<p>Lehrer:";
		while($rowLehrer = $lehrer->fetch_object()) {
			$modal .= " $rowLehrer->Teacher_Name,";
		}
		$modal = rtrim($modal, ',');
		$modal .= "</p>";
		//Modal schließen  
		$modal .="
		</div>
			<div class='modal-footer'>
				<a href='#!' class='modal-action modal-close waves-effect waves-green btn-flat'>OK</a>
				<a href='#modalEditEvent$row->Event_ID' class='modal-action waves-effect waves-green btn-flat'>EDIT</a>
			</div>
		</div>";
		
		echo $modal;

		//Bearbeitungsfeld mit den Daten füllen
		createModalforChangeEvent($row);
	}
	
	function createModalforChangeEvent($row){	
	
		include("db.php");
		$lehrer = $db->query("select Teacher_Name from Event natural join EventwithTeacher where Event_ID = $row->Event_ID;");
		$db->close();

		//Modal beginnen
		$modal = 
		"<div id='modalEditEvent$row->Event_ID' class='modal bottom-sheet'>
			<form action='' method='post'>
				<div class='modal-content'>
					<h4>Hinzufügen</h4>
					<div class='row'>
						<div class='input-field col s6'>";
							
			//TITEL auffüllen
			if ($row->Titel != null || $row->Titel != ""){
				$modal .= "<input id='first_name' type='text' name='titel' class='validate' value='$row->Titel' required>";
			}else{
				$modal .= "<input id='first_name' type='text' name='titel' class='validate' required>";
			}
			
			$modal .= "	<label for='first_name'>Titel *</label></div>
						<div class='input-field col s6'>";
			
			//Beschreibung auffüllen
			if ($row->Description != null || $row->Description != ""){
				$modal .= "<input id='first_name' type='text' name='beschreibung' class='validate' value='$row->Description'>";
			}else{
				$modal .= "<input id='first_name' type='text' name='beschreibung' class='validate'>";
			}
			
			$modal .= "	<label for='first_name'>Beschreibung</label></div>
						<div class='input-field col s6'>";
						
			//Datum auffüllen
			if ($row->Date != null || $row->Date != ""){
				$modal .= "<input id='first_name' type='text' name='datum' class='validate' value='$row->Date'>";
			}else{
				$modal .= "<input id='first_name' type='text' name='datum' class='validate'>";
			}
		
			$modal .= "	<label for='first_name'>Datum *</label></div>
						<div class='input-field col s6'>";
						
			//Zusatzpersonen auffüllen
			if ($row->Person != null || $row->Person != ""){
				$modal .= "<input id='first_name' type='text' name='zusatzpersonen' class='validate' value='$row->Person'>";
			}else{
				$modal .= "<input id='first_name' type='text' name='zusatzpersonen' class='validate'>";
			}
			
			$modal .= "	<label for='first_name'>Zusatzpersonen</label></div>
						<div class='input-field col s6'>";
						
			//Anfangsstunde auffüllen
			if ($row->Begin_Hour != null || $row->Begin_Hour != ""){
				$modal .= "<input id='first_name' type='text' name='anfangsstunde' class='validate' value='$row->Begin_Hour'>";
			}else{
				$modal .= "<input id='first_name' type='text' name='anfangsstunde' class='validate'>";
			}
			
			$modal .= "	<label for='first_name'>Anfangsstunde *</label></div>
						<div class='input-field col s6'>";
						
			//EndStunde auffüllen
			if ($row->End_Hour != null || $row->End_Hour != ""){
				$modal .= "<input id='first_name' type='text' name='endstunde' class='validate' value='$row->End_Hour'>";
			}else{
				$modal .= "<input id='first_name' type='text' name='endstunde' class='validate'>";
			}
			
			$modal .= "	<label for='first_name'>EndStunde *</label></div>
						<div class='input-field col s6'>";
			
			//Lehrer auffüllen
			if ($row->End_Hour != null || $row->End_Hour != ""){
				$modal .= "<input type='text' id='lehrer' class='typeahead2 tt-query' autocomplete='off' spellcheck='false'></input>";
			}else{
				$modal .= "<input type='text' id='lehrer' class='typeahead2 tt-query' autocomplete='off' spellcheck='false' placeholder='Lehrer suchen'></input>";
			}		
		
			//Lehrer einfügen
			$modal .= "<p>Lehrer:";
			while($rowLehrer = $lehrer->fetch_object()) {
				$modal .= " $rowLehrer->Teacher_Name,";
			}
			
			
			$modal .= 
			"			</div>
					</div>
				</div>
					<div class='modal-footer'>	
						<button type='submit' class='modal-action waves-effect waves-light btn-flat' name='btnChange'>Änderung speichern</button>
						<input type='submit' class='modal-action waves-effect waves-light btn-flat modal-close' value='Abbrechen'></input>
					</div>
				</form>
			</div>";
		echo $modal;
		
		if(isset($_POST["btnChange"])){
			global $db;		
			$klasse = $_SESSION["klasse"];
			$titel = $_POST["titel"];
			$beschreibung = $_POST["beschreibung"];
			$datum = $_POST["datum"];
			$zusatzpersonen = $_POST["zusatzpersonen"];
			$anfangsstunde = $_POST["anfangsstunde"];
			$endstunde = $_POST["endstunde"];
			
			$getTeacherOfEvent = $db->query("select * from EventwithTeacher where Event_ID = $row->Event_ID;");
			$lehrer = array();
			$i=0;
			
			while($zeile = $getTeacherOfEvent->fetch_object()) {
				$lehrer[$i] =  $zeile->Teacher_Name;
				$i++;
			}
			
			//Eintrag aus der Datenbank löschen
			$sqlDelete = $db->query("delete from EventwithSchoolClass where Event_ID = $row->Event_ID");
			$sqlDelete = $db->query("delete from EventwithTeacher where Event_ID = $row->Event_ID");
			$sqlDelete = $db->query("delete from Event where Event_ID = $row->Event_ID");

			$sql= $db->prepare("insert into Event(Titel,Description,Date,Person,Begin_Hour,End_Hour) VALUES(?,?,?,?,?,?)");
			$sql->bind_param("ssssii", $titel, $beschreibung, $datum, $zusatzpersonen, $anfangsstunde, $endstunde);
			
			if($sql->execute()){
				$eventID = $sql->insert_id;
				
				$i = 0;
				while($i < count($lehrer)) {
					$sql3 = $db->prepare("insert into EventwithTeacher(Event_ID, Teacher_Name) VALUES (?,?);");
					$sql3->bind_param("is", $eventID, $lehrer[$i]);
					if($sql3->execute()) {}
					else {
						echo "<script type='text/javascript'>alert(Fehler - Daten konnten nicht hinzugefügt werden');</script>";
					}
					$sql3->close();
					$i++;
				}
				
				$sql2 = $db->prepare("insert into EventwithSchoolClass(Event_ID, SchoolClass_Description) VALUES (?,?);");
				$sql2->bind_param("is", $eventID, $klasse);
				if($sql2->execute()) {								
					echo "<script type='text/javascript'>alert('Daten hinzugefügt!');</script>";
				}else{
					echo "<script type='text/javascript'>alert(Fehler - Daten konnten nicht hinzugefügt werden');</script>";
				}
			}else{
				echo "<script type='text/javascript'>alert(Fehler - Daten konnten nicht hinzugefügt werden');</script>";
			}
		}
	}
	
	
	
?>