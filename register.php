<?php
	
	// if ($_SERVER["REQUESTS_METHOD"] == "POST")
	// {
		// $Username = $_POST["Username"];
		// $Password = hash("sha256", $_POST["Pass"]);
		// $FName = $_POST["FName"];
		// $MName = $_POST["MName"];
		// $LName = $_POST["LName"];
		// $Year = $_POST["Year"];
		// $Email = $_POST["Email"];
		
		//open database
		require("./functions.php");
		// block server-side form discrepancies from entering the database (must implement on client-side as well)
		if(!isset($_POST['FName']) || !isset($_POST['LName']) || !isset($_POST['Username']) || !isset($_POST['Pass']) || !isset($_POST['confirmPass']) || !isset($_POST['Year']) || !isset($_POST['Email']))
		{
			echo "Please fill all fields";
		}
		else if(hash("sha256", $_POST["Pass"]) != hash("sha256", $_POST['confirmPass']))
		{
			echo "Passwords did not match";
		}
		else
		{
			$result = query("SELECT * FROM alumni WHERE Username = ?", $_POST['Username']);
			$count = count($result);
			if ($count != 0)
			{
				echo "Username already exists";
			}
			else
			{
				$insert = query("INSERT INTO alumni (Username, Hash, FName, MName, LName, Year, Email) VALUES(?, ?, ?, ?, ?, ?, ?)", 
					$_POST["Username"], 
					hash("sha256", $_POST["Pass"]), 
					$_POST["FName"], 
					$_POST["MName"],
					$_POST["LName"],
					$_POST["Year"], 
					$_POST["Email"]); 
			}
		}
	// }
	// else
	// {
	// 	echo "POST HERE";
	// }


?>