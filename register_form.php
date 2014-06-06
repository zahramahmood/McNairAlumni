<html>
	<head>
		<title>Alumni Registration</title>
	</head>

	<body>
		<form id="registration" method="post" action="register.php">
			<table>
				<tr>
					<td><input type="text" name="FName" placeholder="First Name" required></td>
					<td><input type="text" name="MName" placeholder="Middle Initial"></td>
					<td><input type="text" name="LName" placeholder="Last Name" required></td>
				</tr>
				<tr>
					<!--Want to add feature for check availability of username-->
					<td><input type="email" name="Email" placeholder="Email" required></td>
					<td>Class Year: <select type="select" name="Year" form="registration" required>
							<script>
								var date = new Date();
								for(var i = 1976; i<=date.getFullYear(); i++)
								{
									document.write('<option value="'+i+'">'+i+'</option>');
								}
							</script>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="text" name="Username" placeholder="Username" required></td>
				</tr>
				<tr>
					<td><input type="password" name="Pass" placeholder="Password" required></td>
				</tr>
				<tr>
					<td><input type="password" name="confirmPass" placeholder="Confirm Password"required></td>
				</tr>
				<tr>
				</tr>
					<td><input type="submit" value="Register"></td>
				</tr>
		</table>
		</form>
	</body>
</html>