<?php
    session_start();
    if(!isset($_SESSION['username'])){
      header("Location: http://web.engr.oregonstate.edu/~herrickl/assignment6/home.html", true);        die();
      exit;
    }
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name='description' content='>
    <meta name='author' content='>
    <link rel='icon' href='../../favicon.ico'>
    <title>MTG Deck Builder</title>
    <!-- Bootstrap core CSS -->
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <!-- Custom styles for this template -->
    <link href='jumbotron.css' rel='stylesheet'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src='../../assets/js/ie8-responsive-file-warning.js'></script><![endif]-->
    <script src='js/ie-emulation-modes-warning.js'></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
  </head>
  <body>
    <nav class='navbar navbar-inverse navbar-fixed-top'>
      <div class='container'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='userHome.php'>Home</a>
        </div>
        <a class='navbar-brand' href='cardSearch.php'>Search<a/>
        <a class='navbar-brand' href='messageBoard.php'>Message Board</a>
        <a class='navbar-brand' style = "float:right" href= "logout.php">Logout</a>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class='jumbotron'>
      <div class='container'>
        <h1>Card Search</h1>
        <form class="form-signin">
            <h2>Search By Name - <font size="4">this returns an exact card</font></h2> <p style = "font-size: 14px">This needs to by typed exactly
            as it would be seen on the card and is case sensitive. Example: Fact or Fiction</p>
            <label for="cardName" class="sr-only">Card Name</label>
            <input type="text" id="cardName"  class="form-control" placeholder="Card Name">
            <button class="btn btn-lg btn-primary btn-block" id="nameSearch" type="button">Search Name</button>
            <h2>Search By Type - <font size="4">this returns a list of cards</font></h2> <p style = "font-size: 14px">This needs to by typed exactly
            as it would be seen on the card and is case sensitive. Example: Instant</p>
            <label for="cardType" class="sr-only">Card Type</label>
            <input type="text" id="cardType" class="form-control" placeholder="Card Type">
            <button class="btn btn-lg btn-primary btn-block" id="typeSearch" type="button">Search Type</button>
            <h2>Search By Color - <font size="4">this returns a list of cards</font></h2>
            <center><label for="cardColor" style="font-size:150%">Red</label>
            <input type="radio" id="red" style = "margin-right:10%"class="form-inline">
            <label for="cardColor" style="font-size:150%">Blue</label>
            <input type="radio" id="blue" style = "margin-right:10%"  class="form-inline">
            <label for="cardColor" style="font-size:150%">Green</label>
            <input type="radio" id="green" style = "margin-right:10%" class="form-inline">
            <label for="cardColor" style="font-size:150%">Black</label>
            <input type="radio" id="black" style = "margin-right:10%" class="form-inline">
            <label for="cardColor" style="font-size:150%">White</label>
            <input type="radio" id="white" style = "margin-right:10%" class="form-inline"></center>
            <button class="btn btn-lg btn-primary btn-block" id="colorSearch" type="button">Search Color</button>
      <footer>
        <br>
        <span class="errormess"></span>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='js/cardFunctions.js' type ="text/javascript"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src='js/ie10-viewport-bug-workaround.js'></script>
  </body>
</html>