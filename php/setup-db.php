<?php

$document_root=$_SERVER['DOCUMENT_ROOT'];

require $document_root.'/php/connect.php';
require $document_root.'/php/functions.php';

// setup tables
$tables = array(
    "CREATE TABLE `gamebet`.`Users`(
        username VARCHAR(255) NOT NULL ,
        email VARCHAR(255) NOT NULL ,
        pwd VARCHAR(255) NOT NULL ,
        streamer BOOLEAN NOT NULL ,
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
        link TEXT NOT NULL ,
        gameId VARCHAR(255) NOT NULL ,
        userId VARCHAR(255) NOT NULL ,
        platform VARCHAR(255) NOT NULL ,
        matchFormat SET('Youtube','Twitch') NOT NULL ,
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

foreach($tables as $table) {
    $table_name = explode("`", $table)[3];
    $result = mysqli_query($conn, "SHOW TABLES LIKE '". $table_name . "';");
    if (mysqli_num_rows($result) == 0) { 
        echo "- Creating table " . $table_name . "<br>";
        mysqli_query($conn, $table);
    }
}

// fill tables
require $_SERVER['DOCUMENT_ROOT']."/php/static-data.php";

// fill Users table
$result = mysqli_query($conn, "SELECT EXISTS (SELECT 1 FROM Users) as `row_exists`;");
if (mysqli_fetch_assoc($result)["row_exists"] == 0) { 
    echo "Adding fake Users data...<br>";
    forEach($usernames as $username) {
        $streamer = rand(0,1);
        $sql = "INSERT INTO Users (email, pwd, streamer, username) VALUES ('".strtolower($username)."@fakemail.com', '123456', '".rand(0,1)."', '".$username."');";
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