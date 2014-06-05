<?php
function open_mysql(){
	$user = "root";
	$pass = "root";
	$host = "localhost";
	$database = "mcnair";

	$conn = mysql_connect($host,$user,$pass);
	mysql_select_db($database, $conn);
}
?>