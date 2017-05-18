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
	$i = 0;
	
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
	
	function addStunde($tag, $stunde, $eventsArray, $isSchool) {		
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
				'7' => '0',				
				'8' => '0',				
				'9' => '0',	
			);
			while($i < $eventsProTag) {
				$array = $tag[$i];
				$begHour = $array['Begin_Hour'];
				$endHour = $array['End_Hour'];
				if($array['Begin_Hour'] <= $stunde && $array['End_Hour'] >= $stunde && in_array($stunde, $eventsArray) && $stundeHatEintrag[$stunde] == '0') {
					$stundeHatEintrag[$stunde] = '1';
					echo "<td><a href='#modalEvent$array[Event_ID]' id='$array[Event_ID]')><b>$array[Titel]&nbsp;</b>am $array[Date]</a></td>";
				} else if(in_array($stunde, $eventsArray)){ } else if($stundeHatEintrag[$stunde] == '0'){
					echo"<td><a href='#modalAdd'>Add FÜ</a></td>";
					$stundeHatEintrag[$stunde] = '1';
				}
				$i++;
			} 				
		} else if($isSchool >= $stunde){
			echo"<td><a href='#modalAdd'>Add FÜ</a></td>";
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
		//Edit with NINZ code
	}
	
?>