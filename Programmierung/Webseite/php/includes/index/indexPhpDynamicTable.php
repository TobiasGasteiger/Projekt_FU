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
								
								//F�gt jede einzelne Stunde ein, F�, AddF� oder nichts (wenn kein Unterricht ist)
								function addStunde($tag, $stunde, $eventsArray, $isSchool) {		
									$eventsProTag = count($tag);
									
									//Array Stunde hat einen Eintrag erstellen, zu Beginn jede Stunde 0, falls etwas eingetragen wird (F� oder AddF�) dann 1, 3 steht f�r keine Schule
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
									if($eventsProTag > 0) {
										$i = 0;
										//solange an einem Tag Events sind
										while($i < $eventsProTag) {
											$array = $tag[$i];
											$begHour = $array['Begin_Hour'];
											$endHour = $array['End_Hour'];
											//Es ist zu jetztigen Stunde F�
											if($array['Begin_Hour'] <= $stunde && $array['End_Hour'] >= $stunde && in_array($stunde, $eventsArray) && $stundeHatEintrag[$stunde] == '0') {
												$stundeHatEintrag[$stunde] = '1';
												echo "<td><a href='#modalEvent$array[Event_ID]' id='$array[Event_ID]')><b>$array[Titel]&nbsp;</b>am $array[Date]</a></td>";
											//Es ist zu jetztigen kein F�, aber Unterricht
											} else if($stundeHatEintrag[$stunde] == '0' && $isSchool >= $stunde){
												echo"<td>Leer</td>";
												$stundeHatEintrag[$stunde] = '1';
											}
											$i++;
										} 	
									//Wenn einem Tag keine Events sind aber Schule ist
									} else if($isSchool >= $stunde){
										echo"<td>Leer</td>";
										$stundeHatEintrag[$stunde] == '1';
									//Wenn keine Schule ist
									} else if($stundeHatEintrag[$stunde] = '3'){
										echo"<td><a href='#modalAdd'>&nbsp;</a></td>";
										$stundeHatEintrag[$stunde] == '1';
									}
								}
								
								//Diese Funktion erstell dynamisch die Modals f�r jedes Event, mit den jeweilig richtigen Funktionen
								function createModalforEvent($row) {
									//Die beteiligten Lehrer f�r das jeweilige Event laden
									include("db.php");
									$lehrer = $db->query("select Teacher_Name from Event natural join EventwithTeacher where Event_ID = $row->Event_ID;");
									$db->close();
									//Modal beginnen
									$modal = 
									"<div id='modalEvent$row->Event_ID' class='modal'>
										<div class='modal-content'>
										  <h4>$row->Titel</h4>";
									//Wenn es einge Beschreibung gibt einf�gen
									if ($row->Description != null || $row->Description != ""){
										$modal .= "<p>Beschreibung: $row->Description</p>";
									}
									//Datum einf�gen
									$modal .= "<p>Datum: $row->Date in der $row->Begin_Hour - $row->End_Hour Stunde</p>";	
									//Lehrer einf�gen
									$modal .= "<p>Lehrer:";
									while($rowLehrer = $lehrer->fetch_object()) {
										$modal .= " $rowLehrer->Teacher_Name,";
									}
									$modal = rtrim($modal, ',');
									$modal .= "</p>";
									//Modal schlie�en  
									$modal .="
									</div>
										<div class='modal-footer'>
											<a href='#!' class='modal-action modal-close waves-effect waves-green btn-flat'>OK</a>
										</div>
									</div>";
									
									echo $modal;

									//Bearbeitungsfeld mit den Daten f�llen
									createModalforChangeEvent($row);
								}
								
								function createModalforChangeEvent($row){
									//Edit with NINZ code
								}
								
						?>