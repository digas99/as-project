<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div id="navbar" class="sticky">
    <a href="home" style="font-size: 40px; padding: 10px; font-family: 'Inter', sans-serif;">Gamebet</a>
    <a href="wallet" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Wallet</a>
    <a href="points" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Points</a>
    <a href="friends" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Friends</a>
    <a href="profile" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Profile</a>
    <a href="friends" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Friends</a>
    <a href="stats" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Stats</a>
    <a href="settings" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif; ">Settings</a>
    <a href="faq" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;" >FAQ</a>
    <a href="login?submit=logout" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Logout</a>
    <div style="
				display: flex;
				align-items: center;
				position: absolute;
				right: 10px;">
		  <a href="searchNavbar"><i class="fa fa-fw fa-search" style="font-size: 25px; padding: 5px;"></i> </a>
		  <a href="deposit">
		  	<div class="balance-box">
		  		<div>
		  			<div><?php echo $_SESSION["userMoney"] ?> €</div>
		  		</div>
		  		<div>
		  			<div></div>
		  			<div></div>
		  		</div>
		  	</div>
		  </a>
		  <a href="points">
		  	<div class="balance-box">
		  		<div>
		  			<div><?php echo $_SESSION["userPoints"] ?></div>
		  			 <img style="width: 22px;
										filter: invert(1);
										margin-left: 5px;
										opacity: 0.4;"
									src="/images/gp-logo.png">
		  		</div>
		  		<div>
		  			<div></div>
		  			<div></div>
		  		</div>
		  	</div>
		  </a>
		  <a style="position: relative;" href="#ticketNavbar">
			<img id="ticketNavbarImg" src="/images/ticket.png">
			<div class="ticketNavbar-counter"><div>0</div></div>
		  </a>
			<a style="font-size: 16px;"><?php echo $_SESSION["userUsername"] ?></a>
  	</div>
</div>
<script type="text/javascript" src="js/navbar.js"></script>