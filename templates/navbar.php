<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div id="navbar" class="sticky">
    <a href="home" style="font-size: 40px; padding: 10px; font-family: 'Inter', sans-serif;">Gamebet</a>
    <a href="wallet" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Wallet</a>
    <a href="#points" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Points</a>
    <a href="#friends" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Friends</a>
    <a href="#profile" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Profile</a>
    <a href="#stats" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Stats</a>
    <a href="#settings" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif; ">Settings</a>
    <a href="#faq" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;" >FAQ</a>
    <a href="#logout" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Logout</a>
    <a href="#friends" style="font-size: 20px; padding: 20px; font-family: 'Inter', sans-serif;">Friends</a>
    <a href="#searchNavbar"><i class="fa fa-fw fa-search" style="font-size: 25px; padding: 5px;"></i> </a>
    <a href="deposit">
    	<div class="balance-box">
    		<div>
    			<div>0€</div>
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
    			<div>0</div>
    			 <img style="width: 22px;
									filter: invert(1);
									margin-left: 5px;"
								src="/images/gp-logo.png">
    		</div>
    		<div>
    			<div></div>
    			<div></div>
    		</div>
    	</div>
    </a>
    <a href="#ticketNavbar"><img id="ticketNavbarImg" src="/images/ticket.png"></a>
		<a style="font-size: 16px;">
  	<?php 
  		require $_SERVER['DOCUMENT_ROOT']."/php/functions.php";
  		$userData = apiFetch("http://localhost/api/users?keys=username&id=".rand(1,50));
  		echo $userData["data"][0]["username"];
  	?>
  	</a>
</div>


