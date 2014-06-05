<?php
function open_mysql(){
	$user = "root";
	$pass = "root";
	$host = "localhost";
	$database = "mcnair";

	$conn = mysql_connect($host,$user,$pass) or die("Could not connect: " . mysql_error());
	if(!$conn)
	{
		echo "Cannot connect to Database";
	}
	else
	{
		mysql_select_db($database, $conn);

	}
}
?>