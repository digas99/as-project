<?php

$method = $_SERVER['REQUEST_METHOD']; 
if ($method === 'GET') {
    header('Content-type: application/json; charset=utf-8');

    require $_SERVER['DOCUMENT_ROOT'].'/php/connect.php';
    
    $response = array();
    $data = array();
    $filter = 1;

    if (isset($_GET["id"])) $filter = "id = '".$_GET["id"]."'";
    else if (isset($_GET["name"])) $filter = "name LIKE '%". $_GET["name"] ."%'";

    $query = "SELECT * FROM Games WHERE ".$filter;
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    } 
    
    $response["data"] = $data;
    $response["size"] = count($data);
    $response["timestamp"] = date('Y-m-d H:i:s');
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}