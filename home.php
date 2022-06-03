<head>
  <link rel="stylesheet" href="css/home.css"/>
  <link rel="stylesheet" href="css/navbar.css"/> 
  <!--Importing icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link href="http://fonts.cdnfonts.com/css/avenir-lt-std" rel="stylesheet" as="style" onload="this.rel='stylesheet'">
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



<input type="image" img id="sortRightSearchBar" src="/Icons/sort.png">
<input type="image" img id="starRightSearchBar" src="/Icons/star.png">

<hr id="purpleLine">

<div class="games-list">

</div>

<script type="text/javascript" src="js/navbar.js"></script>
<script type="text/javascript" src="js/home.js"></script>
</body>








