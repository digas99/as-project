<?php

$method = $_SERVER['REQUEST_METHOD']; 
if ($method === 'GET') {
    header('Content-type: application/json; charset=utf-8');

    require $_SERVER['DOCUMENT_ROOT'].'/php/connect.php';
    
    $response = array();
    $data = array();
    $filter = 1;
    $columns = "*";

    if (isset($_GET["id"])) $filter = "id = '".$_GET["id"]."'";
    else if (isset($_GET["userId"])) $filter = "userId = '".$_GET["userId"]."'";

    if (isset($_GET["ticketType"])) $filter = $filter . " AND ticketType LIKE '%". $_GET["ticketType"] ."%'";

    if (isset($_GET["keys"])) {
        // get Tickets columns
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'Tickets' AND TABLE_SCHEMA = 'gamebet'";
        $result = mysqli_query($conn, $query);
        $usersColumns = array();
        while($row = mysqli_fetch_assoc($result)) {
            $usersColumns[] = $row["COLUMN_NAME"];
        }

        // only keep columns that are from Tickets
        $columns = join(",", array_intersect($usersColumns, explode(",", $_GET["keys"])));
    }

    $users = array();
    if (!isset($_GET["keys"]) || (isset($_GET["keys"]) && str_contains($_GET["keys"],"user"))) {
        // get users
        $query = "SELECT * FROM Users";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $users[$row["id"]] = $row;
        }
    }

	if (!str_contains($columns, "id")) $columns = $columns.($columns != "" ? "," : "")."id";

    if (count($users) > 0 && str_contains($_GET["keys"],"user")) $columns = $columns .",userId";

	$query = "SELECT ". $columns ." FROM Tickets WHERE ". $filter;
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($result)) {
	    if (count($users) > 0) {
            $row["user"] = $users[$row["userId"]];
	    }
			
	    $data[] = $row;
	} 
    
    $response["data"] = $data;
    $response["size"] = count($data);
    date_default_timezone_set("Europe/Lisbon");
    $response["timestamp"] = date('Y-m-d H:i:s');
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
