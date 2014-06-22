<?php
function query_g(){
    // SQL statement
    $sql = func_get_arg(0);
    echo "1";

    // parameters, if any
    $parameters = array_slice(func_get_args(), 1);
    echo "2";
    // try to connect to database
    static $handle;
    if (!isset($handle))
    {
        echo "3";
        try
        {
            $user = "root";
            $pass = "root";
            $host = "localhost";
            $database = "mcnair";

            // connect to database
            $handle = new PDO("mysql:dbname=" . $database . ";host=localhost", $user, $pass);
            echo "4";

            // ensure that PDO::prepare returns false when passed invalid SQL
            $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            echo "5";
        }
        catch (Exception $e)
        {
            echo "6";
            // trigger (big, orange) error
            trigger_error($e->getMessage(), E_USER_ERROR);
            echo "7";
            exit;
        }
    }
    echo "8";
    // prepare SQL statement
    $statement = $handle->prepare($sql);
    echo "9";
    if ($statement === false)
    {
        echo "10";
        // trigger (big, orange) error
        trigger_error($handle->errorInfo()[2], E_USER_ERROR);
        exit;
    }
    echo "11";
    // execute SQL statement
    $results = $statement->execute($parameters);
    echo "12";

    echo "\n $results";
    // return result set's rows, if any
    if ($results !== false)
    {
        echo "13";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        echo "14";
        return false;
    }
}

function query_f(/* query, [...] */){
    $user = "root";
    $pass = "root";
    $host = "localhost";
    $database = "mcnair";
    $conn = mysqli_connect($host,$user,$pass,$database);
    if(!$conn)
    {
        echo "Cannot connect to Database";
    }
    else
    {
        mysqli_select_db($conn, $database);
    }

    // store query
    $query = func_get_arg(0);
    $parameters = array_slice(func_get_args(), 1);
    $param = "'".implode("','",$parameters)."'";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt == false)
    {
        echo "The statement could not be created";
        exit;
    }

    // Bind the parameters
    $bind = mysqli_stmt_bind_param($stmt, 's', $param);
    echo mysqli_stmt_error($stmt);
    if ($bind == false)
    {
        echo "Could not bind";
    }
    else
    {
        echo "Bind successful";
    }

    // Execute the statement
    $execute = mysqli_stmt_execute($stmt);
    echo mysqli_stmt_error($stmt);
    if ($execute == false)
    {
        echo "Could not execute";
    }

    // $result = mysqli_stmt_bind_result($stmt, $param);
    // if ($result == false)
    // {
    //     echo $param;
    //     echo "Could not bind results";
    // }

    // fetch the data
    $fetch = mysqli_stmt_fetch($stmt);
    echo mysqli_stmt_error($stmt);
    if ($fetch == false)
    {
            echo "Could not fetch data";
    }
    else
    {
        return $fetch;
    }
}
$result = query_f("SELECT * FROM alumni WHERE Username = ?", "zm123");
var_dump($result);
?>