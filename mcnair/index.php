<?php 
	function login($user=""){ return '<tr><td><input type="text" name="Username" id="Username" value="'.$user.'" placeholder="Username"/></td></tr><tr><td><input type="password" name="Password" placeholder="Password" id="Pass"/></td></tr><tr colspan=2><td><button onclick="verifyPass();return false;">Login</button></td></tr>';
	}

	$loginMenu = "";

	if(!isset($_POST['Username']) && !isset($_POST['Password'])) $loginMenu = login();
	else if(!isset($_POST['Username']) or $_POST['Username'] == ""){
		$loginMenu = "<tr><td>Please provide your username</td></tr>".login();
	}
	else if(!isset($_POST['Password']) or $_POST['Password'] == null){
		$loginMenu = "<tr><td>Please provide your password</td></tr>".login($_POST['Username']);
	}
	else{
		require("functions.inc");
		open_mysql();

		$Username = $_POST['Username'];
		$Password = $_POST['Password'];

		$qry = "SELECT Hash FROM alumni WHERE Username = '$Username'";
		$result = mysql_query($qry);
		
		if($result){
			$hash = mysql_fetch_array($result)['Hash'];

			if(hash("sha256", $Password) == $hash){
				session_start();
				$_SESSION['Username'] = $Username;
				header("Location:./alumniSearch.php");
			}
			else $loginMenu = "<tr><td>Incorrect password</td></tr>".login($Username);

		}
		else{
			$loginMenu = "<tr><td>Can't find your username in the database</td></tr>".login();
		}
	}
	
?>

<html>
<head>
	<title>Welcome McNair Alumni</title>
	<style>
		*{ /*css reset*/
			margin:0;
			/*padding:0;
			border:0;
			outline:0;*/
		}

		img{
		    position:absolute;
		    top:0;
		    display:none;
		    width:100%;
		    height:auto;
		    z-index: -1;
		}

		#loginMenu{
			text-align: center;
			position: absolute;
			top: 50%;
			left: 50%;
			margin-top: -64.5px;
			margin-left: -46.5px; 
		}


	</style>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script>

	//add that somewhat fade

	$(document).ready(function(){
		//images must be large 1000px x 1000px
		images = [<? 
				$imgExtensions = array(".jpg", ".png");
				$list = "";
				foreach(scandir("./images") as $fileName){
					if(in_array(substr($fileName, strlen($fileName)-4), $imgExtensions)){
						$list .= '"' . $fileName . '", ';
					}
				}
				echo substr($list, 0, strlen($list) - 2);
			?>];

		$('img').hide();

		var i=0;
		function anim(){
			$("#bgWrap img").first().appendTo('#bgWrap').fadeOut(3000);

    		$("#bgWrap img").first().attr("src",'./images/'+images[i++ % images.length]);    
    		$("#bgWrap img").first().fadeIn(3000);
    		setTimeout(anim, 4000);
			// $("#background2").fadeOut(5000);
			// $("#background2").css("background-image",'url(./images/'+images[i++ % images.length]+')');
			
			// $("#background2").fadeIn(5000);
			// ("#background1").css("background-image",'url(./images/'+images[i++ % images.length]+')');	   
		 //    setTimeout(anim(), 5800);
		}

		anim();
	});
	</script>

</head>
<body>
	<div id="bgWrap">
		<img src="./images/bg1.jpg">
		<img src="./images/bg2.jpg">
<!-- 		<div id="background1" style='background-image:url("./images/bg3.jpg");'></div>
		<div id="background2" style='background-image:url("./images/bg1.jpg");'></div> -->
	</div>

	<form name="form1" method="post" action="index.php">
	<table id="loginMenu">
		<? echo $loginMenu;?>
	</table>
	</form>



</body>
</html>