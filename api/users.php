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

    if (isset($_GET["keys"])) {
        // get Users columns
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'Users' AND TABLE_SCHEMA = 'gamebet'";
        $result = mysqli_query($conn, $query);
        $usersColumns = array();
        while($row = mysqli_fetch_assoc($result)) {
            if ($row["COLUMN_NAME"] !== "pwd")
                $usersColumns[] = $row["COLUMN_NAME"];
        }

        // only keep columns that are from Users
        $columns = join(",", array_intersect($usersColumns, explode(",", $_GET["keys"])));
    }
  
    $userGamesAssoc = array();
    $gameIds = array();
    $games = array();
    if (!isset($_GET["keys"]) || (isset($_GET["keys"]) && str_contains($_GET["keys"],"games"))) {
        // get user<->games association
        $query = "SELECT * FROM UserGames";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $userGamesAssoc[$row["userId"]][] = $row["gameId"];
            $gameIds[] = $row["gameId"];
        }

        // get games info from the games that matter
        $query = "SELECT * FROM Games WHERE id IN (" . join(",", $gameIds) . ")";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $games[$row["id"]] = $row;
        }
    }

	if (!str_contains($columns, "id")) $columns = $columns.($columns != "" ? "," : "")."id";
	
        $query = "SELECT ". $columns ."  FROM Users WHERE ". $filter;
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
            if (isset($row["streamer"]))    
                $row["streamer"] = $row["streamer"] == "1";
    
            if (isset($userGamesAssoc[$row["id"]])) {
                foreach($userGamesAssoc[$row["id"]] as $gameId) {
                    $row["games"][] = $games[$gameId];
                }
            }
    
            $data[] = $row;
        }
    
    $response["data"] = $data;
    $response["size"] = count($data);
    $response["timestamp"] = date('Y-m-d H:i:s');
    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
