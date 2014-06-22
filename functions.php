<?php

/* Never use mysql_query function ever again. 
 * Simply use $result = query(" SQL STATEMENT "), will have same result as:
 * $query = "SQL Statement";
 * $result = mysql_query($query); <----------- This is what this function will return. 
 * 
 * Do not use any other mysql or mysqli functions either
 * 
 * RETURNS AN ARRAY OF ALL ROWS
 * So if result only returns 1 row, you have to index into the array at index 0.
 * use count() function to mimic mysql_num_rows function to get number of rows
 */
function query(/* QUERY [, param1, param2...paramX] */){
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
?>