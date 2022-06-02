<?php

$method = $_SERVER['REQUEST_METHOD']; 
if ($method === 'GET') {
    header('Content-type: application/json; charset=utf-8');

    require $_SERVER['DOCUMENT_ROOT'].'/php/connect.php';
    
    $response = array();
    $data = array();
    $filter = 1;
    $columns = "username,email,streamer,id";

    if (isset($_GET["id"])) $filter = "id = '".$_GET["id"]."'";
    else if (isset($_GET["username"])) $filter = "username LIKE '%". $_GET["username"] ."%'";
    else if (isset($_GET["email"])) $filter = "email LIKE '%". $_GET["email"] ."%'";
    
    if (isset($_GET["streamer"])) $filter = $filter . " AND streamer = '". ($_GET["streamer"] == "true" ? "1" : "0") ."'";

    if (isset($_GET["keys"]) && !str_contains($_GET["keys"],"pwd")) $columns = $_GET["keys"]; 

    $query = "SELECT ". $columns ."  FROM Users WHERE ". $filter;
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        if (isset($row["streamer"]))    
            $row["streamer"] = $row["streamer"] == "1" ? true : false;
        $data[] = $row;
    } 
    
    $response["data"] = $data;
    $response["size"] = count($data);
    $response["timestamp"] = date('Y-m-d H:i:s');
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}