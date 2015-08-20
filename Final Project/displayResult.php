<?php
    session_start();
    if(!isset($_SESSION['username'])){
      header("Location: home.html", true);        die();
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
    <meta name='description' content=''>
    <meta name='author' content=''>
    <link rel='icon' href='../../favicon.ico'>
    <title>MTG Deck Builder</title>
    <!-- Bootstrap core CSS -->
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <!-- Custom styles for this template -->
    <link href='css/jumbotron.css' rel='stylesheet'>
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
        <h1>Results</h1>
        <div id ="buildCard">
          <br>
<?php
  if($_SESSION['cardName'] != NULL) {
    $xml = simplexml_load_file("cards/cards.xml");
    //loop through "cards"
    foreach($xml->cards as $cards){
      foreach ($cards->card as $card) {
        if($card->name == $_SESSION['cardName']){
          //found it!  get vars
          echo "<p><b>Card Name: </b><span id='cardName'>".$card->name."</span></p>";
          echo "<p> <b>Color: </b><span id='cardColor'>".$card->color."</span></p>";
          echo "<p><b> Type: </b><span id='cardType'>".$card->type."</span></p>";
          echo "<p><b> Mana Cost: </b><span id='cardCost'>".$card->manacost."</span></p>";
          echo "<p><b>Text: </b><span id='cardText'>".$card->text."</span></p>";
          echo"<br>";
          echo "<center><input type='number' id='numCards' min='1' max='200' placeholder=' Amount'>  <button class='btn btn-lg btn-primary ' id='addButton' type='button'>Add to Deck</button></center>";
        }
      }
    }
  }
  else if($_SESSION['cardType'] != NULL){
    $xml = simplexml_load_file("cards/cards.xml");
    foreach($xml->cards as $cards){
      foreach ($cards->card as $card) {
        if($card->type == $_SESSION['cardType']){
          //found it!  get vars
          echo "<p><b>Card Name: </b><span id='cardName'>".$card->name."</span></p>";
          echo "<p> <b>Color: </b><span id='cardColor'>".$card->color."</span></p>";
          echo "<p><b> Type: </b><span id='cardType'>".$card->type."</span></p>";
          echo "<p><b> Mana Cost: </b><span id='cardCost'>".$card->manacost."</span></p>";
          echo"<br><hr>";
        }
      }
    }
  }
  else if($_SESSION['cardColor'] != NULL){
    $xml = simplexml_load_file("cards/cards.xml");
    foreach($xml->cards as $cards){
      foreach ($cards->card as $card) {
        //single color cards
        if($card->color == $_SESSION['cardColor']){
          //found it!  get vars
          echo "<p><b>Card Name: </b><span id='cardName'>".$card->name."</span></p>";
          echo "<p> <b>Color: </b><span id='cardColor'>".$card->color."</span></p>";
          echo "<p><b> Type: </b><span id='cardType'>".$card->type."</span></p>";
          echo "<p><b> Mana Cost: </b><span id='cardCost'>".$card->manacost."</span></p>";
          echo"<br><hr>";
        }
        
      }
    }
  }
  else{
    echo "Cound not find any cards with those specifications.";
  }
?>
        </div>
      <footer>
        <span class="errormess"></span>
      </footer>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/displayCard.js" rel="text/javascript"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src='js/ie10-viewport-bug-workaround.js'></script>
  </body>
</html>