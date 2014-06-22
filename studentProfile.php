<?php
	session_start();
	if(isset($_POST['Username'])) $_SESSION['Username'] = $_POST['Username'];

	$Username = $_SESSION['Username'];

	require("./functions.php");

	$result = query("SELECT * FROM alumni WHERE Username = ?", $Username);

	$row = $result[0];

	//FORMAT PROFILE here
	//can let people connect to linkedin and facebook so they don't feel like they have fill in more info
?>

<html>
	<head>
		<title><?echo $row['FName']." " .$row['LName'];?></title>
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script>
			$(document).ready(function(){

				// convert $row array to json object to be manipulated by javascript
				<?
				echo 'var js_array = '.json_encode($row).';';
				?>

				// create new array that only stores values with non-numeric keys
				var elements = new Array();
				for (var key in js_array)
				{
					if (key.search(/[^A-Za-z\s]/) == -1)
					{
						elements[key] = js_array[key];
					}
				}

				// hides any element with id where its value is empty string
				for (var key in elements)
				{
					console.log(key);
					if (key != 'UID' || key != 'Username' || key != 'Hash')
					{
						var currentID = document.getElementById(key);
						if (elements[key] == "")
						{
							$(currentID).hide();
						}
					}
				}
			})
		</script>
	<head>
	<body>
		<h1>
			<?echo $row['FName']. " " . $row['LName'];?>
		</h1>
		<table>
			<tr id='Email'>
				<td class='field'>
					<a>Email: </a>
				</td>
				<td class='info'>
					<a><?echo $row['Email'];?></a>
				</td>
			</tr>
			<tr id='Phone'>
				<td class='field'>
					<a>Phone: </a>
				</td>
				<td class='info'>
					<a><?echo $row['Phone'];?></a>
				</td>
			</tr>
			<tr id='Year'>
				<td class='field'>
					<a>Year: </a>
				</td>
				<td class='info'>
					<a><?echo $row['Year'];?></a>
				</td>
			</tr>
			<tr id='Industry'>
				<td class='field'>
					<a>Industry: </a>
				</td>
				<td class='info'>
					<a><?echo $row['Industry'];?></a>
				</td>
			</tr>
			<tr id='Company'>
				<td class='field'>
					<a>Company: </a>
				</td>
				<td class='info'>
					<a><?echo $row['Company'];?></a>
				</td>
			</tr>
			<tr id='Occupation'>
				<td class='field'>
					<a>Occupation: </a>
				</td>
				<td class='info'>
					<a><?echo $row['Occupation'];?></a>
				</td>
			</tr>
			<tr id='UndergradInst'>
				<td class='field'>
					<a>Undergraduate Institution: </a>
				</td>
				<td class='info'>
					<a><?echo $row['UndergradInst'];?></a>
				</td>
			</tr>
			<tr id='UndergradMajor'>
				<td class='field'>
					<a>Undergraduate Major: </a>
				</td>
				<td class='info'>
					<a><?echo $row['UndergradMajor'];?></a>
				</td>
			</tr>
			<tr id='GradInst'>
				<td class='field'>
					<a>Graduate Institution: </a>
				</td>
				<td class='info'>
					<a><?echo $row['GradInst'];?></a>
				</td>
			</tr>
			<tr id='GradMajor'>
				<td class='field'>
					<a>Graduate Major: </a>
				</td>
				<td class='info'>
					<a><?echo $row['GradMajor'];?></a>
				</td>
			</tr>
		</table>
	</body>
</html>