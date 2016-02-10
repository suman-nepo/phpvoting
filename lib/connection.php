<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$link = mysql_connect($servername, $username, $password);
// Check connection
if (!$link) {
    die('Not connected : ' . mysql_error());
}

//Select Database
$db_selected = mysql_select_db('bkfkvoting', $link);
if (!$db_selected) {
	die ('Database connection error!');
}
?>