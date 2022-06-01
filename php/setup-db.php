<?php

require 'connect.php';

// setup tables
$users = "CREATE TABLE `gamebet`.`Users`(
	username VARCHAR(255) NOT NULL ,
	email VARCHAR(255) NOT NULL ,
	pwd VARCHAR(255) NOT NULL ,
    streamer BOOLEAN NOT NULL ,
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
)";

$games = "CREATE TABLE `gamebet`.`Games`(
	gameName VARCHAR(255) NOT NULL ,
	cover TEXT NOT NULL ,
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
)";

$streams = "CREATE TABLE `gamebet`.`Streams`(
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
)";

$bets = "CREATE TABLE `gamebet`.`Bets`(
	streamId VARCHAR(255) NOT NULL ,
	betGroup VARCHAR(255) NOT NULL ,
    resultType VARCHAR(255) NOT NULL ,
    resultTeam VARCHAR(255) NOT NULL ,
    odd VARCHAR(255) NOT NULL ,
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT
)";

foreach(array($users, $games, $streams, $bets) as $table) {
    $table_name = explode("`", $table)[3];
    $result = mysqli_query($conn, "SHOW TABLES LIKE '". $table_name . "';");
    if (mysqli_num_rows($result) == 0) { 
        echo "Creating table " . $table_name . "<br>";
        mysqli_query($conn, $table);
    }
}