<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "APNG";
$con = mysqli_connect($servername, $username, $password,$db);
if (!$con) {
	die("Connection failed: " . mysqli_connect_error());
}
?>