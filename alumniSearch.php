<html>
	<head>
		<title>Alumni Database</title>
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="./autocomplete/jquery.autocomplete.js"></script>s
		<link type="text/css" rel="stylesheet" href="./autocomplete/styles.css">
		<style>
			body{
				background-image: url("./images/database.jpg");
			}
			h1{
				text-align: center;
				font-family: sans-serif;
				color: white;
			}
			#searchBar{
				border-collapse: collapse;
				opacity: 0.4;
				filter: alpha(opacity=40); /* for IE8 and earlier*/
				margin: -10px 100px;
				text-align: center;
			}
			#searchBar:hover{
				opacity: 1.0;
				filter: alpha(opacity=100); /* for IE8 and earlier*/
				background: (0,0,0,0.4)
			}
			#searchResults{
				table-layout: fixed;
				margin: 20px;
				width: 800px;
				background: rgba(255,255,255,0.4);
				margin-left: auto;
				margin-right: auto;

			}
			#searchResults>tbody>tr>td{
				height: 200px;
			}
			#searchResults>tbody>tr>td:hover{
				background: rgba(0,0,0,0.4);
				color: white;
			}
			#studentName{
				position: relative;
				top: 8px;
				text-align: center;
				font-family: sans-serif;
				font-size: small;
			}
			#studentPicture{
				position: relative;
				left: 20px;
				height: 140px;
				width: 115px;
				padding-bottom: 5px;
			}
		</style>
	</head>

	<body>
		<?include_once 'navigation.php';?>
		<h1>Student Database</h1>
		<form method="post" action="alumniSearch.php" id="searchBar">
			<input type="text" placeholder="First Name" id="FName" name="FName">
			<input type="text" placeholder="Last Name" id="LName" name="LName">
			<select type="select" name="year">
				<?
					require("./functions.php");

					$result = query("SELECT DISTINCT Year FROM alumni");
					foreach($result as $row)
					{
						echo "<option value=".$row['Year'].">".$row['Year']."</option>";
					}
				?>
			</select>
			<input type="submit" value="Search!">
		</form>
		<div>
			<table id='searchResults'>
				<colgroup>
					<col><col><col><col><col>
				</colgroup>
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
					
					$result = query($query);
					$n = count($result);
					$fullData = array();
					foreach($result as $row)
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
								"<form name='student{$p}' method='post' action='studentProfile.php'>
									<td>
										<img id='studentPicture' src='./images/profilePics/{$fullData[$p]['Username']}.jpg' onerror=\"this.src='./images/profilePics/cougar.jpg';\" onclick='document.student{$p}.submit();'>
										<div id='studentName'>
											<input type='hidden' name='Username' value='{$fullData[$p]['Username']}'>
											<a onclick='document.student{$p}.submit();'>{$fullData[$p]['LName']}, {$fullData[$p]['FName']}</a>
										</div>
									</td>
								</form>";
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
	<script>
		<?php
			//echoes (not returns) a list of options for autocompleteArray
			function autocompleteArray($col){
				$result = query("SELECT DISTINCT $col FROM alumni");
				$i = 0;
				foreach($result as $val){
					echo '"'.$val[$col].'"';
					if(++$i != count($result)) echo ",";
				}
			}
		?>

		$("#FName").autocomplete({lookup: [ <? autocompleteArray("FName");?>] });
		$("#LName").autocomplete({lookup: [<? autocompleteArray("LName");?>] });
	</script>
</html>