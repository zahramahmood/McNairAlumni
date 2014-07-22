<?php 
	session_start();
	if(!isset($_SESSION['Username']))
	{
		header("Location:./index.php");
	}
	
	require("functions.php");
	

	
	function create_event()
	{
		$result = query("INSERT INTO events (Host, EventName, Guests, Location, Date, StartTime, EndTime, EventDetails) VALUES(?,?,?,?,?,?,?,?)", 
			$_SESSION['Username'], 
			$_POST['EventName'], 
			$_POST['Guests'],
			$_POST['Location'],
			$_POST['Date'], 
			$_POST['StartTime'],
			$_POST['EndTime'],
			$_POST['EventDetails']
			);
	}

	echo var_dump($_POST);

	// if($_POST['typeofrequest'] == "getevents"){
	// 		create_event();
	// 		echo var_dump($_POST);
	// }
	// else {
	// 	echo "fuck it";
	// }


	// echo $_POST['submit'];
	// if(isset($_POST['submit']))
	// {
	// 	create_event();
	// }
?>