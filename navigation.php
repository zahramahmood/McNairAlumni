<style>
	#navigationBar{
		color: white;
		font-family: sans-serif;
		text-align: center;
		margin-left: auto;
		margin-right: auto;
		table-layout: fixed;
		width: 1000px;
	}
	#navigationBar>tbody>tr>td{
		background: rgba(165,85,0,0.4);
		padding: 10px;
		margin-left: 10px;
	}
	#navigationBar>tbody>tr>td:hover{
		background: rgba(255,135,0,0.4);
	}
	#navigationBar>tbody>tr>td>a:visited{
		color: white;
		font-family: sans-serif;
		text-decoration: none;
	}
	#navigationBar>tbody>tr>td>a:link{
		color: white;
		font-family: sans-serif;
		text-decoration: none;
	}
	#navigationBar a{
		width: 100%;
		height: 100%;
		display: block;
	}

</style>

<table id='navigationBar'>
	<tr>
		<td><a href='./home.php'>Home</a></td>
		<td><a href='./myProfile.php'>My Profile</a></td>
		<td><a href='./inbox.php'>Inbox</a></td>
		<td><a href='./alumniSearch.php'>Alumni Database</a></td>
		<td><a href='./events.php'>Events</a></td>
		<td><a href='./logout.php'>Logout</a></td>
	</tr>
</table>