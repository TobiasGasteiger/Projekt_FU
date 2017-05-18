<?php
	include("db.php");
	
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
		</div>
	";		
?>