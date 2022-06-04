<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/home.css"/>
  <link rel="stylesheet" href="css/essentials.css"/>
  <link rel="stylesheet" href="css/navbar.css"/> 
  <linl rel="stylesheet" href="css/homeGame.css"/>
  <!--Importing icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>

<?php include "templates/navbar.php"?>

<form style="max-width:300px; margin:20px; position:absolute; top:7%; left:75% ">
      <div class="input-icons">
          <i class="fa fa-search icon"></i>
          <input class="input-field"
                 type="text"
                 placeholder="Game, streamer, ...">
      </div>
  </form>


<div class="title-Game">
  <p <a href="home.html"">home</a> /League Of Legends <p style="color:#f50083;font-weight: bold;"> 402 eventos</p></p>
</div>


<input type="image" img id="starLeftSearchBar" src="/images/star.png">

<hr size="4" width="95%" color="#f50083">  

<div class="boxes">
  <div class="box"> <input type="image" img id="FotoSearchBar" src="/images/player.jpg"> </div>
  <div class="box"></div>
  <div class="box"></div>
</div>



<div class="vertical"></div>
<input type="image" img id="FotoRiotEnd" src="/images/foto.jpg">

<script type="text/javascript" src="js/navbar.js"></script>
<script type="text/javascript" src="js/home.js"></script>
</body>
</html>
