<html>
	<head>
		<title>Alumni Database</title>
	</head>

	<body>
		<form method="post" action="alumniSearch.php">
			<input type="text" placeholder="First Name" name="FName">
			<input type="text" placeholder="Last Name" name="LName">
			<select type="select" name="year">
				<?
					require("./functions.inc");
					open_mysql();
					$query = "SELECT DISTINCT Year FROM alumni";
					$result = mysql_query($query);
					while ($row = mysql_fetch_array($result))
					{
						echo "<option value=".$row['Year'].">".$row['Year']."</option>";
					}
				?>
			</select>
			<input type="submit" value="Search!">
		</form>
		<div>
			<table>
			<?
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					$query = "SELECT * FROM alumni WHERE ";
					if (isset($_POST['FName']) && $_POST['FName'] != "")
					{
						$query.="FName LIKE '" . $_POST['FName'] . "%' && ";
					}
					if (isset($_POST['LName']) && $_POST['LName'] != "")
					{
						$query.="LName LIKE '" . $_POST['LName'] . "%' && ";
					}
					if (isset($_POST['Year']))
					{
						$query.=" Year = '" .$_POST['Year']. "'" ;
					}


					if(substr($query, strlen($query)-3) == "&& "){
						$query = substr($query, 0, strlen($query)-3);
					}
					else if(substr($query, strlen($query)-6) == "WHERE "){
						$query = substr($query, 0, strlen($query)-6);
					}
					
					$result = mysql_query($query);
					while($row = mysql_fetch_array($result)){
						echo "<tr><td>".$row['FName']."</td><td>".$row['Year']."</tr>";
					}
				}
			?>
			</table>
		</div>
	</body>
</html>