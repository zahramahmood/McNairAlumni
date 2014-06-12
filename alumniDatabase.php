<?php 
	require("./functions.inc");

	//backend
	//frontend
	//security

	open_mysql();

	/*
	* specifically used for autocompletes
	* when a user is typying into a text input, and that text input sends an ajax reuqest
	* to this file for an autocomplete, this function will be called
	* 
	* Requires the field being searched and the characters already inputted
	*
	* Returns a JSON string of the choices that must be echoed.
	*/
	function autocompleteData($field, $char){
		$choices = [];

		$query = "SELECT $field FROM alumni WHERE $field LIKE '$char"."%'";
		$result = mysql_query($query);

		while($row = mysql_fetch_array($result)){

			array_push($choices,$row[$field]);
			if(count($choices) >= 5) break;
		}

		array_push($choices, $char);

		// if(count($choices) < 5){
		// 	$query = "SELECT $field FROM alumni WHERE $field LIKE '%". $char."%'";
		// 	$result = mysql_query($query);

		// 	while($row = mysql_fetch_array($result)){
		// 		if(!in_array($row[$field], $choices)) array_push($choices,$row[$field]);

		// 		if(count($choices) >= 5) break;
		// 	}
		// }

		// if(count($choices) < 5){
		// 	$query = "SELECT $field FROM alumni WHERE $field LIKE '%". $char."'";
		// 	$result = mysql_query($query);

		// 	while($row = mysql_fetch_array($result)){
		// 		if(!in_array($row[$field], $choices)) array_push($choices,$row[$field]);

		// 		if(count($choices) >= 5) break;
		// 	}
		// }
		
		$JSON = "[ ";
		foreach($choices as $choice){
			$JSON .= '"'.$choice.'", ';
		}
		return substr($JSON, 0, strlen($JSON)-2) . '  ]';
	}

	echo autocompleteData($_REQUEST['field'], $_REQUEST['char']);
?>