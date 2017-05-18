<?php
	include("../db.php");
    $key=$_GET['key'];
    $array = array();
    $query=mysql_query("select * from SchoolClass where SchoolClass_Description LIKE '{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['SchoolClass_Description'];
    }
    echo json_encode($array);
?>
