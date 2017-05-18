<?php
	include("../db.php");
    $key=$_GET['key'];
    $array = array();
    $query=mysql_query("select * from Teacher where Teacher_Name LIKE '{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['Teacher_Name'];
    }
    echo json_encode($array);
?>
