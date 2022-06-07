<?php require $_SERVER['DOCUMENT_ROOT'].'/php/check-session.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css"/>
  <link rel="stylesheet" href="css/deposit.css"/>
  <link rel="stylesheet" href="css/essentials.css"/>
  <link rel="icon" href="/images/GameBetLogo-square.png">
  <title>Withdraw - Gamebet</title>
</head>

<body>
  <?php include "templates/navbar.php"?>

  <div class="title">
    <h1>Withdrawal</h1>
  </div>

  <div class="image">
    <!-- image -->
  </div>

  <div class="input-field">
    <input type="text" placeholder="Withdrawl Account">
  </div>

  <div class="withdraw-money">
    <button type="button">Start Withdrawing Money</button>
  </div>





  <script type="text/javascript" src="js/withdraw.js"></script>
</body>
</html>