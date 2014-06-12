<html>
	<head>
		<title>Alumni Database</title>
		



		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <style>
  .ui-autocomplete-loading {
    background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;
  }
  </style>
  <script>
  $(function() {
    $( "#birds" ).autocomplete({
      source: "alumniDatabase.php?field=FName&char="+$('#birds').val(),
      minLength: 2,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });
  });
  </script>







	</head>

	<body>





<div class="ui-widget">
  <label for="birds">Birds: </label>
  <input id="birds">
</div>




		<form method="post" action="alumniSearch.php">
			<input type="text" placeholder="First Name" id="tags" name="FName">
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
					$i=0;
					while($row = mysql_fetch_array($result)){
						echo "<tr>
							<form name='student"."$i' method='post' action='studentProfile.php'>
								<input type='hidden' name='Username' value='".$row['Username']."'>
								<td><a onclick='document.student"."$i.submit();'>".$row['FName']."</a></td><td>".$row['Year']."</a>
							</form>
							</tr>";
					}
				}
			?>
			</table>
		</div>
	</body>
</html>