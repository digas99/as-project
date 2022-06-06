<?php require $_SERVER['DOCUMENT_ROOT'].'/php/check-session.php'; ?>

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
    
  <h1>Wallet</h1>

  <!-- Diogo, mete os nºos sff, em cima de deposit e win points-->

  <a href="deposit"><button type="button" id="deposit">Deposit</button>
  <a href="#"><button type="button" id="withdraw">Withdraw</button> 
  <a href="#"><button type="button" id="points">Win GameBet Points</button>
    
  <hr id="line">

  <a href="#"><button type="button" id="balance">Balance History</button>
  <a href="#"><button type="button" id="account">My Account</button>
  <a href="#"><button type="button" id="bets">Bets</button>
  <a href="#"><button type="button" id="invite">Invite Friend</button>
  <a href="#"><button type="button" id="invite10">+ 10€</button>
    
  <script type="text/javascript" src="js/home.js"></script>
</body>
