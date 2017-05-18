<?php
	global $db;
	if(isset($_POST['typeahead'])) {
		$lehrer = $_POST['typeahead'];
		echo "<center>";
		$erg= $db->query("select * from Teacher where Teacher_Name LIKE '$lehrer'");
		echo "<script>document.getElementById('lehrer').value</script>";
		while($zeile= $erg->fetch_object()){
			echo "<pre>";
			echo "<font face='Arial' size='6'> $zeile->Teacher_Name</font><br>";
			echo "</pre>";		
		}
	}
?>