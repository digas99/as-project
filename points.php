<?php 
	require $_SERVER['DOCUMENT_ROOT'].'/php/check-session.php'; 
	require $_SERVER['DOCUMENT_ROOT'].'/php/functions.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css"/>
  <link rel="stylesheet" href="css/points.css"/>
  <link rel="stylesheet" href="css/essentials.css"/>
  <link rel="icon" href="/images/GameBetLogo-square.png">
  <title>Points - Gamebet</title>
</head>

<body>

<?php include "templates/navbar.php"?>


<div class="linear-gradient"></div>

<div class="points_balance">
    <h1> Points </h1>
    <button type="button">Balance: 0 </button>
    <div>
        <img src="/images/gp-logo.png" style="width: 42px">
    </div>
</div>








</body>
</html>
