<?php
	// if ($_SERVER["REQUESTS_METHOD"] == "POST")
	// {
		$Username = $_POST["Username"];
		$Password = hash("sha256", $_POST["Pass"]);
		$FName = $_POST["FName"];
		$MName = $_POST["MName"];
		$LName = $_POST["LName"];
		$Year = $_POST["Year"];
		$Email = $_POST["Email"];
		
		//open database
		require("./functions.inc");
		open_mysql();

		// block server-side form discrepancies from entering the database (must implement on client-side as well)
		if(!isset($_POST['FName']) || !isset($_POST['LName']) || !isset($_POST['Username']) || !isset($_POST['Pass']) || !isset($_POST['confirmPass']) || !isset($_POST['Year']) || !isset($_POST['Email']))
		{
			echo "Please fill all fields";
		}
		else if($Password != hash("sha256", $_POST['confirmPass']))
		{
			echo "Passwords did not match";
		}
		else
		{
			$username_query = "SELECT * FROM alumni WHERE Username = '$Username";
			$count = mysql_num_rows($username_query);
			echo $count;
			if ($count != 0)
			{
				echo "Username already exists";
			}
			$query = "INSERT INTO alumni (Username, Hash, FName, MName, LName, Year, Email) VALUES('$Username', '$Password', '$FName', '$MName', '$LName', '$Year', '$Email')"; 
			$insert = mysql_query($query) or die(mysql_error(). " " . mysql_errno());

		}
	// }
	// else
	// {
	// 	echo "POST HERE";
	// 	var_dump($_POST);
	// }


?>