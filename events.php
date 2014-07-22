<html>
	<head>
		<title>Events</title>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
		<style>
			#createEventForm{
				display: none;
			}
			.createEventDialog .ui-dialog-titlebar-close{
				display: none;
			}
		</style>
		<script>
		$(document).ready(function(){
			$('#createEvent').click(function(){
				$('#createEventForm').dialog
				({
					dialogClass: "createEventDialog", 
					closeOnEscape: true
				});
			});


			$('#submit').click(function(){
				console.log($("#submit").serialize());
				var xhr = new XMLHttpRequest(); // 1) Create the XML HTTP Request object
				xhr.onreadystatechange = function(){ // 2) define what to do once given data
					if(xhr.readyState == 4 && xhr.status == 200){
						// $("#upcomingEvents").replace(xhr.responseText);
						console.log(xhr.responseText);
					}
				}
				xhr.open('POST', 'eventController.php', true); // 3) Set up the AJAX request
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xhr.send(new FormData("#submit")); // 4) send the AJAX request
				return false;


				// $.ajax({
				// 	type: "POST", 
				// 	data: $("#submit").serialize(),
				// 	url: "eventController.php",
				// 	success: console.log("This works!!!")
				// });
			});
		});
		</script>
	</head>
	<body>
		<?include_once 'navigation.php';?>
		<h1>My Events</h1>
		<div id='upcomingEvents'>
			<a>There are no upcoming events</a>
		</div>
		<button id='createEvent'>Create Event</button>
		
		<div id='createEventForm'>
			<form method='post' id='submitEventForm'>
				<input type='text' placeholder='Event Name' id='EventName' name='EventName'>
				<input type='text' placeholder='Guests' id='Guests' name='Guests'>
				<input type='text' placeholder='Location' id='Location' name='Location'>
				<input type='text' placeholder='Date' id='Date' name='Date'>
				<input type='text' placeholder='Start Time' id='StartTime' name='StartTime'>
				<input type='text' placeholder='End Time' id='EndTime' name='EndTime'>
				<input type='text' placeholder='Event Details' id='EventDetails' name='EventDetails'>
				<input type="submit" value="Create Event" id='submit'>
			</form>
		</div>
	</body>
</html>