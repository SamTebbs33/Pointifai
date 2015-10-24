<?php
require_once 'secure/keys.php';
$databaseUsername = $key_db_username;
$databasePassword = $key_db_password;
$databaseHostName = "localhost";
$databasePort = "3600";
$databaseName = "pointifai-production";
//Open MySQL connection to server
$link = mysqli_connect($databaseHostName, $databaseUsername, $databasePassword, $databaseName, $databasePort);
//Check if connection worked
if (mysqli_connect_errno()) {
	die('Database connection failed');
}