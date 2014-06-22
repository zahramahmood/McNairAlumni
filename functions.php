<?php

/* Never use mysql_query function ever again. 
 * Simply use $result = query(" SQL STATEMENT "), will have same result as:
 * $query = "SQL Statement";
 * $result = mysql_query($query); <----------- This is what this function will return. 
 */
function query(){
	$user = "root";
	$pass = "root";
	$host = "localhost";
	$database = "mcnair";

	$conn = mysqli_connect($host,$user,$pass, $database) or die("Could not connect: " . mysqli_error());
	if(!$conn)
	{
		echo "Cannot connect to Database";
	}

	$query = func_get_arg(0);
	$result = mysqli_query($conn, $query) or die("Could not connect: " . mysqli_error());
	return $result;
}

// function query_f(/* query, [...] */){
// 	$user = "root";
// 	$pass = "root";
// 	$host = "localhost";
// 	$database = "mcnair";
// 	$conn = mysqli_connect($host,$user,$pass);
// 	if(!$conn)
// 	{
// 		echo "Cannot connect to Database";
// 	}
// 	else
// 	{
// 		mysqli_select_db($conn, $database);
// 	}
// 	// store query
// 	$query = func_get_arg(0);
// 	$parameters = array_slice(func_get_args(), 1);
// 	$param = "'".implode("','",$parameters)."'";

// 	// Prepare the statement
// 	$stmt = mysqli_prepare($conn, $query);
// 	if ($stmt == false)
// 	{
// 		echo "The statement could not be created";
// 		exit;
// 	}

// 	// Bind the parameters
// 	$bind = mysqli_stmt_bind_param($stmt, 's', $param);
// 	echo mysqli_stmt_error($stmt);
// 	if ($bind == false)
// 	{
// 		echo "Could not bind";
// 	}
// 	else
// 	{
// 		echo "Bind successful";
// 	}

// 	// Execute the statement
// 	$execute = mysqli_stmt_execute($stmt);
// 	if ($execute = false)
// 	{
// 		echo "Could not execute";
// 	}


	
// 	// fetch the data
// 	$fetch = mysqli_stmt_fetch($stmt)
// 	if ($fetch == false)
// 	{
// 		echo "Could not fetch data";
// 	}
// 	else
// 	{
// 		return $fetch;
// 	}
// }


function query_g(){
    // SQL statement
    $sql = func_get_arg(0);

    // parameters, if any
    $parameters = array_slice(func_get_args(), 1);

    // try to connect to database
    static $handle;
    if (!isset($handle))
    {
        try
        {
        	$user = "root";
			$pass = "root";
			$host = "localhost";
			$database = "mcnair";

            // connect to database
            $handle = new PDO("mysql:dbname=" . $database . ";host=localhost", $user, $pass);

            // ensure that PDO::prepare returns false when passed invalid SQL
            $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
        }
        catch (Exception $e)
        {
            // trigger (big, orange) error
            trigger_error($e->getMessage(), E_USER_ERROR);
            exit;
        }
    }

    // prepare SQL statement
    $statement = $handle->prepare($sql);

    if ($statement === false)
    {
        // trigger (big, orange) error
        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
        exit;
    }

    // execute SQL statement
    $results = $statement->execute($parameters);

    // return result set's rows, if any
    if ($results !== false)
    {
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    else
   	{
        return false;
    }
}

// open_mysql();
// $result = query("SELECT Hash FROM alumni WHERE Username = 'zm123'");
// var_dump($result);
// var_dump(mysql_fetch_array($result));
// $result = query_g("SELECT Hash FROM alumni WHERE Username = '?'", "zm123");
// var_dump($result);
?>