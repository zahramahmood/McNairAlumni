<?php
	session_start();
	if(!isset($_SESSION['Username']))
	{
		header("Location:./index.php");
	}
?>

<html>
	<head>
		<title>Welcome McNair Alumni</title>
	</head>
	<body>
		<?include_once 'navigation.php';?>
		<h1>Welcome McNair Alumni</h1>
	</body>
</html>