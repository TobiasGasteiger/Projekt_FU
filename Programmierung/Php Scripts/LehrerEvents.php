<?php
define('DB_SERVER', 'linuxserver');
define('DB_USERNAME', 'stninmar');
define('DB_PASSWORD', 'mypass');
define('DB_DATABASE', 'projekt_fu');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

$erg= $db->query("select * from Eventwithteacher natural join Event where Teacher_Name LIKE '$lehrer'");



?>