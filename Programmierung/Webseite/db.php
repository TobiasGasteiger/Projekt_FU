<?php
define('DB_SERVER', 'linuxserver');
define('DB_USERNAME', 'ststeraf');
define('DB_PASSWORD', 'mypass');
define('DB_DATABASE', 'projekt_fu');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>