<?php require $_SERVER['DOCUMENT_ROOT'].'/php/check-session.php'; ?>

<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/navbar.css"/>
  <link rel="stylesheet" href="css/deposit.css"/>
  <link rel="stylesheet" href="css/essentials.css"/>
</head>

<body>
  <?php include "templates/navbar.php"?>

  <h1>Deposit</h1>

  <div class="deposit-values">
    <div>
      <button type="button">10€</button>
      <button type="button">20€</button>
    </div>
    <div>
      <button type="button">50€</button>
      <button type="button">100€</button>
    </div>
    <div>
      <button type="button">200€</button>
      <button type="button">500€</button>
    </div>
  </div>

  <input class="input-field" type="text" 
                placeholder="Outro Valor (min. 5€)">

  <img id="pagamento" src="images/pagamento.png">

  <!-- href? depois de carregar em pay now,
             o que acontece?-->
  <button type="button" id="pay">Pay Now</button>
  

   

    



  <script type="text/javascript" src="js/deposit.js"></script>
</body>



