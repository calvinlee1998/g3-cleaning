<?php
include 'dbdetail.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}

function sqlsanitizer($str)
{
    // sql injection filter here
    return $str;
}

function dbsearch($table, $values, $key, $target)
{
    // not tested
    // when call this function, email must have quotation marks
    global $conn;
    $query = "SELECT ";
    foreach ($values as $index => $value) {
        $query .= sqlsanitizer($value);
        if ($index < count($values) - 1) {
            $query .= ", ";
        }
    }
    $query .= " FROM " . sqlsanitizer($table) . " WHERE " . sqlsanitizer($key) . "=" . sqlsanitizer($target) . ";";
    echo $query;
    $dbresult = mysqli_query($conn, $query);

    $result = [];
    if (mysqli_num_rows($dbresult) > 0) {
        while ($row = mysqli_fetch_assoc($dbresult)) {
            array_push($result, $row);
        }
    }
    return $result;
}


function dbsearchmultiple($table, $values, $key, $targets)
{
    // not tested
    // when call this function, email must have quotation marks
    global $conn;
    $query = "SELECT ";
    foreach ($values as $index => $value) {
        $query .= sqlsanitizer($value);
        if ($index < count($values) - 1) {
            $query .= ", ";
        }
    }
    $query .= " FROM " . sqlsanitizer($table) . " WHERE " . sqlsanitizer($key) . " IN (";
    foreach ($targets as $index => $target){
        $query .= $target;
        if ($index < count($targets)-1){
            $query .= ", ";
        }
    } 
    $query .= ");";
    echo $query;
    $dbresult = mysqli_query($conn, $query);

    $result = [];
    if (mysqli_num_rows($dbresult) > 0) {
        while ($row = mysqli_fetch_assoc($dbresult)) {
            array_push($result, $row);
        }
    }
    return $result;
}

function dbsearchall($table, $key, $target)
{
    // when call this function, email must have quotation marks
    global $conn;
    $query = "SELECT * FROM " . sqlsanitizer($table) . " WHERE " . sqlsanitizer($key) . "=";
    $query .= sqlsanitizer($target);
    $query .= ";";
    //echo $query;
    $dbresult = mysqli_query($conn, $query);

    $result = [];
    if (mysqli_num_rows($dbresult) > 0) {
        while ($row = mysqli_fetch_assoc($dbresult)) {
            array_push($result, $row);
        }
    }
    return $result;
}

function insert($table, $values){
    global $conn;
    $query = "";

}
?>