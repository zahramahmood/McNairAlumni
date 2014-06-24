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
		padding: 10px;
	}

</style>

<table id='navigationBar'>
	<tr>
		<td><a>Home</a></td>
		<td><a>My Profile</a></td>
		<td><a>Inbox</a></td>
		<td><a href='./alumniSearch.php'>Alumni Database</a></td>
		<td><a>Events</a></td>
		<td><a>Logout</a></td>
	</tr>
</table>