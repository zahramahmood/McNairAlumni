<?php
	session_start();
	if(isset($_POST['Username'])) $_SESSION['Username'] = $_POST['Username'];

	$Username = $_SESSION['Username'];

	require("./functions.inc");
	open_mysql();
	$query = "SELECT * FROM alumni WHERE Username = '$Username'";
	$result = mysql_query($query);

	$row = mysql_fetch_array($result);

	var_dump($row);

	//FORMAT PROFILE here
	//can let people connect to linkedin and facebook so they don't feel like they have fill in more info
?>