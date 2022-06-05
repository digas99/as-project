<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/game.css"/>
  <link rel="stylesheet" href="css/botão.css"/>
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
  <p style="" href="home.html"">home</a> /League Of Legends <p style="color:#f50083;font-weight: bold;"> 402 eventos</p></p>
</div>


<input type="image" img id="starLeftSearchBar" src="/images/star.png">

<hr size="4" width="96%" color="#f50083">  

  <div class="box"> 
    <div class="horizontalHigh">
       <div class="vertical"></div> 
       <input class="textAbove" type="text" placeholder="23/05/2022"> 
       <input class="textAbove2" type="text" placeholder="17:35">
       <span class="dot"></span>
       <input class="textAbove3" type="text" placeholder="Odds">
       <input class="textAbove4" type="text" placeholder="Odds">
       <input type="image" img id="twitch" src="/images/twitch.png">
       <input type="image" img id="taça" src="/images/trophy.png">
    </div>

    <div class="horizontal">
      <div class="FirstResult">
        <input class="RESULT1" type="text" placeholder="WINNER:"> 
        <input class="Player1" type="text" placeholder="FOR THE WIN SPORTS"> 
        <input class="odd" type="text" placeholder="1.35">
        <!-- Another result sabe se lá pq -->
        <input class="result" type="text" placeholder="WINNER:"> 
        <input class="Player1" type="text" placeholder="FOR THE WIN SPORTS"> 
        <input class="odd" type="text" placeholder="1.35">

          <!-- <div class="container">
            <div class="select-box">
                  <div class="options-container">
                    
                    <div class="option">
                      <input type="radio" class="radio" id="Money" name="category"/>  
                      <label for="automobiles">BetMoney></label>
                    </div>

                    <div class="option">
                      <input type="radio" class="radio" id="Points" name="category"/>  
                      <label for="automobiles">BetPoints></label>
                    </div>

                    <div class="option">
                      <input type="radio" class="radio" id="Group" name="category"/>  
                      <label for="automobiles">BetGroup></label>
                    </div>

                    
                  </div>

                  <div class="selected">
                      <p style="color:black;font-weight: bold;font-size:small">BET</p>
                  </div>
                </div>
          </div> -->
        

      </div>

      <div class="SecondResult">
        <input class="RESULT2" type="text" placeholder="WINNER:"> 
        <input class="Player2" type="text" placeholder="ELECTRONIK GENERATION"> 
        <input class="odd" type="text" placeholder="4.23">
        <!-- Another result sabe se lá pq -->
        <input class="result" type="text" placeholder="WINNER:"> 
        <input class="Player2" type="text" placeholder="ELECTRONIK GENERATION"> 
        <input class="odd" type="text" placeholder="4.23">
      </div>

      <div class="ThridResult">
        <input class="RESULT3" type="text" placeholder="FIRST BLOOD:"> 
        <input class="Player3" type="text" placeholder="FOR THE WIN SPORTS"> 
        <input class="odd" type="text" placeholder="2.86">
        <!-- Another result sabe se lá pq -->
        <input class="resultFor3" type="text" placeholder="FIRST BLOOD:"> 
        <input class="Player3" type="text" placeholder="FOR THE WIN SPORTS"> 
        <input class="odd" type="text" placeholder="2.86">
      </div>

    </div>
    <input type="image" img id="FotoSearchBar" src="/images/player.jpg">  
    <div class="nameOfGame"> Riot Games
      <div class="Lowvertical"></div>
    </div>

    <div class="container">

            <div class="select-box">
                  <div class="options-container">
                    
                    <div class="option">
                      <input type="radio" class="radio" id="Money" name="category"/>  
                      <label for="automobiles">BetMoney></label>
                    </div>

                    <div class="option">
                      <input type="radio" class="radio" id="Points" name="category"/>  
                      <label for="automobiles">BetPoints></label>
                    </div>

                    <div class="option">
                      <input type="radio" class="radio" id="Group" name="category"/>  
                      <label for="automobiles">BetGroup></label>
                    </div>

                    
                  </div>

                  <div class="selected">
                      <p style="color:black;font-weight: bold;font-size:small;text-align:center;">BET</p>
                  </div>
                </div>
          </div>
    
</div>  


<script type="text/javascript" src="js/navbar.js"></script>
<script type="text/javascript" src="js/botão.js"></script>
<script type="text/javascript" src="js/home.js"></script>
</body>
</html>
