<?php

$document_root=$_SERVER['DOCUMENT_ROOT'];

require $document_root.'/php/connect.php';
require $document_root.'/php/functions.php';

// setup tables
$tables = array(
    "CREATE TABLE `gamebet`.`Users`(
        username VARCHAR(255) NOT NULL ,
        email VARCHAR(255) NOT NULL ,
        streamer BOOLEAN NOT NULL ,
        money VARCHAR(255) NOT NULL ,
        points VARCHAR(255) NOT NULL ,
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
    )",
    "CREATE TABLE `gamebet`.`Games`(
        name VARCHAR(255) NOT NULL ,
        cover TEXT NOT NULL ,
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
    )",
    "CREATE TABLE `gamebet`.`Streams`(
        title VARCHAR(255) NOT NULL ,
        thumbnail TEXT NOT NULL ,
        viewers TEXT NOT NULL ,
        gameId VARCHAR(255) NOT NULL ,
        userId VARCHAR(255) NOT NULL ,
        platform SET('Youtube','Twitch') NOT NULL ,
        matchFormat SET('Tournment','Casual') NOT NULL ,
        matchBeginning TIMESTAMP NOT NULL ,
        teamA VARCHAR(255) NOT NULL ,
        teamB VARCHAR(255) NOT NULL ,
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
    )",
    "CREATE TABLE `gamebet`.`Bets`(
        streamId VARCHAR(255) NOT NULL ,
        betGroup VARCHAR(255) NOT NULL ,
        resultType VARCHAR(255) NOT NULL ,
        resultTeam VARCHAR(255) NOT NULL ,
        odd VARCHAR(255) NOT NULL ,
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
    )",
    "CREATE TABLE `gamebet`.`UserGames`(
        userId VARCHAR(255) NOT NULL ,
        gameId VARCHAR(255) NOT NULL ,
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
    )"
);

echo "Adding tables:<br>";
foreach($tables as $table) {
    $table_name = explode("`", $table)[3];
    $result = mysqli_query($conn, "SHOW TABLES LIKE '". $table_name . "';");
    if (mysqli_num_rows($result) == 0) { 
        echo "- Creating table " . $table_name . "<br>";
        mysqli_query($conn, $table);
    }
}

// fill tables
require $document_root."/php/static-data.php";

// fill Users table
$result = mysqli_query($conn, "SELECT EXISTS (SELECT 1 FROM Users) as `row_exists`;");
if (mysqli_fetch_assoc($result)["row_exists"] == 0) { 
    echo "Adding fake Users data...<br>";
    forEach($usernames as $username) {
        $streamer = rand(0,1);
        $sql = "INSERT INTO Users (email, streamer, username, money, points) VALUES ('".strtolower($username)."@fakemail.com', '".rand(0,1)."', '".$username."', '".rand(0,150)."', '".rand(0,2000)."');";
        mysqli_query($conn, $sql);
    }
}

// fill Games table
$result = mysqli_query($conn, "SELECT EXISTS (SELECT 1 FROM Games) as `row_exists`;");
if (mysqli_fetch_assoc($result)["row_exists"] == 0) { 
    echo "Adding fake Games data...<br>";
    forEach($games as $game) {
        $sql = "INSERT INTO Games (name, cover) VALUES ('".$game[1]."', '".$game[0]."');";
        mysqli_query($conn, $sql);
    }
}

// fill UserGames table
$result = mysqli_query($conn, "SELECT EXISTS (SELECT 1 FROM UserGames) as `row_exists`;");
if (mysqli_fetch_assoc($result)["row_exists"] == 0) {
    echo "Randomly matching Users to Games...<br>";
    // get all users ids that are streamers
    $usersIds = array_map(function ($elem) {
        return $elem["id"];
    }, apiFetch("http://localhost/api/users?keys=id&streamer=true")["data"]);
    // get all games ids
    $gamesIds = array_map(function ($elem) {
            return $elem["id"];
    }, apiFetch("http://localhost/api/games?keys=id")["data"]);

    foreach($usersIds as $userId) {
        // get n random games
        $userGames = array_rand(array_flip($gamesIds), rand(1,4));
        $userGames = !is_array($userGames) ? array($userGames) : $userGames;
        foreach($userGames as $game) {
            $sql = "INSERT INTO UserGames (userId, gameId) VALUES ('".$userId."', '".$game."');";
            mysqli_query($conn, $sql);
        }
    }
}

// fill Streams table
$result = mysqli_query($conn, "SELECT EXISTS (SELECT 1 FROM Streams) as `row_exists`;");
if (mysqli_fetch_assoc($result)["row_exists"] == 0) { 
    echo "Adding fake Streams data...<br>";
    $platforms = array("Youtube", "Twitch");
    $matchFormats = array("Tournment", "Casual");
    $queryValues = array();

    $query = "SELECT userId,gameId FROM UserGames";
    $result = mysqli_query($conn, $query);
    $max_possible_streams = mysqli_num_rows($result)*5;
    $max_streams_per_assoc = 5;

    // fetch lorem ipsum for titles from baconipsum.com
    $titles = array();
    for ($i = 0; $i < ceil($max_possible_streams/100); $i++) {
        $titles = array_merge($titles, explode(". ", apiFetch("https://baconipsum.com/api/?type=meat-and-filler&sentences=". $max_possible_streams)[0]));
    }
    shuffle($titles);
    date_default_timezone_set("Europe/Lisbon");
    $counter = 0;

    $query = "SELECT userId,gameId FROM UserGames";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)) {
        // n streams from this user on this game
        $n_streams = rand(1, $max_streams_per_assoc);
        for ($i = 0; $i < $n_streams; $i++) {
            $title = array_pop($titles);
            $thumbnail = 'https://picsum.photos/300/170?random='.$counter++;
            $viewers = rand(100, 100000);
            $userId = $row["userId"];
            $gameId = $row["gameId"];
            $timeMultiplier = rand(0, 10);
            $timeOp = rand(0,1) == "0" ? "-" : "+";
            $beginning = date('Y-m-d H:i:s', strtotime(" ". $timeOp ." ". $timeMultiplier*10 ." minutes"));
            $queryValues[] = "('".$title."', '".$thumbnail."', '".$viewers."', '".$userId."', '".$gameId."', '".$platforms[rand(0,1)]."', '".$matchFormats[rand(0,1)]."', '".$beginning."', '".$teams[rand(0, count($teams)-1)]."', '".$teams[rand(0, count($teams)-1)]."')";
        }
    }
    $sql = "INSERT INTO Streams (title, thumbnail, viewers, userId, gameId, platform, matchFormat, matchBeginning, teamA, teamB) VALUES ". join(",", $queryValues) .";";
    mysqli_query($conn, $sql);
}