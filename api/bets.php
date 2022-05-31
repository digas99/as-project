<?php

header('Content-type: application/json; charset=utf-8');

require $_SERVER['DOCUMENT_ROOT'].'/php/connect.php';

$response = array();
$data = array();

$columns = !isset($_GET["column"]) || $_GET["column"] == '' ? "*" : $_GET["column"];
$columns_from_tables = array();
$tables = isset($_GET["table"]) ? explode(",", $_GET["table"]) : array();
// get all tables if necessary
if (!isset($_GET["table"])) {
    $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='u277832949_serius'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $tables[] = $row["TABLE_NAME"];
    }
    $tables = array_unique($tables);
}

// get columns from selected tables
if (isset($_GET["filter-column"])) {
    foreach ($tables as $table) {
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'". $table ."' AND TABLE_SCHEMA = 'u277832949_serius'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $columns_from_tables[$table][] = $row["COLUMN_NAME"];
        }
    } 
}
    
foreach ($tables as $table) {
    if ($columns != "*" && isset($_GET["filter-column"]))
        $columns = join(",", array_intersect($columns_from_tables[$table], explode(",", $_GET["column"])));
    
    if (isset($_GET["filter-column"]) && isset($_GET["filter-value"]) && isset($_GET["filter-op"])) {
        foreach (explode(",", $_GET["filter-column"]) as $filter_column) {
            $filter = " WHERE " . $filter_column . " " . $_GET["filter-op"] . " '" . $_GET["filter-value"] . "'";
            $query = "SELECT " . $columns . " FROM " . $table . $filter;
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
                $data[$table][] = $row;
            }  
        }
    }
    else {
        $query = "SELECT " . $columns . " FROM " . $table;
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $data[$table][] = $row;
        }   
    }
}


$response["data"] = $data;
$response["timestamp"] = date('Y-m-d H:i:s');
echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>
