<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/login.css"/>
    <link rel="stylesheet" href="css/essentials.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <div id="container">
        <div class="button button-sec"><a href="signup">Create Account</a></div>

        <h1 style="margin-top: 30px;" id="login-title">Login</h1>

        <!-- não encontrei a imagem que está no prototipo-->
        <img src="images/AS-logo.png" id="logo">

        <form class="auth-form" method="post" action="login.php">
            <div>
                <img src="images/email.png">        
                <input placeholder="email@example.com" type="text" name="username" required>
            </div>
            <div>
                <img src="images/lock.png">     
                <input placeholder="password" type="password" name="password" required>
            </div>
            <input class="button" type="submit" value="Login">                         
        </form> 
    </div>

    <script type="text/javascript" src="js/login.js"></script>
</body>
</html>

<?php

$method = $_SERVER['REQUEST_METHOD']; 
if ($method === 'POST') {

}

?>