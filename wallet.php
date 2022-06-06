<?php require $_SERVER['DOCUMENT_ROOT'].'/php/check-session.php'; ?>

<!DOCTYPE html>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css"/>
  <link rel="stylesheet" href="css/wallet.css"/>
  <link rel="stylesheet" href="css/essentials.css"/>
  <link rel="icon" href="/images/GameBetLogo-square.png">
  <title>Wallet - Gamebet</title>
</head>

<body>
  <?php include "templates/navbar.php"?>
   
  <div class="title">
    <h1>Wallet</h1>
  </div>

  <div class="middle-buttons">
    <div>
      <div>
        <div> 0,00€</div> <!-- Diogo, backend aqui sff (mostrar €) -->
        <a href="deposit"><button type="button">Deposit</button></a>
        <a href="withdraw"><button type="button">Withdraw</button></a>
      </div>
      <!-- Diogo, backend aqui sff (mostrar pontos) -->
      <div> 
        <div> 0 <img src="/images/gp-logo.png" 
          style="width: 42px; filter: invert(27%) sepia(33%) 
          saturate(811%) hue-rotate(86deg) brightness(88%) contrast(87%);"></div>
          <!-- O invert não dá a cor exata, mas os valores são esses, não sei -->
        <a href="points"><button type="button">Win GameBet Points</button></a>
      </div>
    </div>
  </div> 

  <hr id="line">

  <div class="bottom-buttons">
    <a href="balance"><button type="button">Balance History</button></a>
    <a href="account"><button type="button">My Account</button></a>
    <a href="bets"><button type="button">Bets</button></a>
    <a href="#">
      <button type="button">Invite Friend</button>
      <div><button type="button">+ 10€</button></div>
    </a>
  </div>

  <script type="text/javascript" src="js/home.js"></script>
</body>
</html>
