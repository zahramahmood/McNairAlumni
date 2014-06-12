<html>
	<head>
		<title>Alumni Database</title>
		<style>
			h1{
				text-align: center;
				font-family: sans-serif;
			}
			#searchBar{
				border-collapse: collapse;
				border: 1px solid orange;
				opacity: 0.4;
				filter: alpha(opacity=40); /* for IE8 and earlier*/
				margin: -10px 100px;
				text-align: center;
			}
			#searchBar:hover{
				opacity: 1.0;
				filter: alpha(opacity=100); /* for IE8 and earlier*/
			}
			table td{
				background-color: yellow;
				text-align: center;
			}
			table{
				margin: 10px 10px;
			}
		</style>
	</head>

	<body>
		<h1>Student Database</h1>
		<form method="post" action="alumniSearch.php" id="searchBar">
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
						$query = substr($query, 0, strlen($query)-3) . " ORDER BY LName, FName";
					}
					else if(substr($query, strlen($query)-6) == "WHERE "){
						$query = substr($query, 0, strlen($query)-6) . " ORDER BY LName, FName";
					}
					
					$result = mysql_query($query);
					$n = mysql_num_rows($result);
					$fullData = array();
					while($row = mysql_fetch_array($result))
					{
						$fullData[] = $row;
					}
					for ($i = 0; $i <= $n; $i+= 5)
					{
						echo "<tr>";
						for ($j = 0; $j < 5; $j++)
						{		
							$p = $i + $j;
							if (isset($fullData[$p]))
							{
								echo 
								"<td>
									<form name='student{$p}' method='post' action='studentProfile.php'>
										<input type='hidden' name='Username' value='{$fullData[$p]['Username']}'>
										<a onclick='document.student{$p}.submit();'>{$fullData[$p]['FName']}</a>
									</form>
								</td>";
							}
						}
						echo "</tr>";
					}
							// echo " <table><tr>
							// <form name='student"."$i' method='post' action='studentProfile.php'>
							// 	<input type='hidden' name='Username' value='".$row['Username']."'>
							// 	<td><a onclick='document.student"."$i.submit();'>".$row['FName']."</a></td><td>".$row['Year']."</a>
							// </form>
							// </tr></table>";
							// $i++;
					
				}
			?>
		</table>
		</div>
	</body>
</html>