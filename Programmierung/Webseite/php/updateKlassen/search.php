<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysql_connect("linuxserver","ststeraf","mypass");
    $db=mysql_select_db("projekt_fu",$con);
    $query=mysql_query("select * from SchoolClass where SchoolClass_Description LIKE '{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['SchoolClass_Description'];
    }
    echo json_encode($array);
?>
