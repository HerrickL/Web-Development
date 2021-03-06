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
    <meta name='description' content='>
    <meta name='author' content='>
    <link rel='icon' href='../../favicon.ico'>
    <title>MTG Deck Builder</title>
    <!-- Bootstrap core CSS -->
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    <!-- Custom styles for this template -->
    <link href='jumbotron.css' rel='stylesheet'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/messages.js"></script>
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
        <h1>Message Board</h1>
        <p>Leave a message below.</p>
        <span class="errormess"></span>
        <textarea maxlength="1000" rows="5" id="uMessage" style="width: 100%"></textarea>
        <button class="btn btn-lg btn-primary btn-block" id="messSubmit" type="button">Submit Message</button>
        <hr>
        <p>Recent Messages</p>
        <table class ='table'>
          <thead>
            <tr>
              <th width="100px">Timestamp</tb>
              <th width="100px">Username</th>
              <th>Message</th>
            </tr>
          </thead>
          <tbody> 
            <?php
              include "extra.php";
              //check if rows in database
              $usersDB = new mysqli($myURL, $myDataBase, $myPassword, $myDataBase);
              if ($usersDB->connect_errno) {
                echo "Could not access the database at this time.";
              }
              //prepare - order decending
              if (!($stmt = $usersDB->prepare("SELECT username, stamp, message FROM messageboard ORDER BY id DESC"))) {
                echo "Prepare ";
              }
              //execute
              if (!$stmt->execute()) {
                echo "Execute ";
              }
              //bind results
              if(!$stmt->bind_result($username, $stamp, $message)){
                echo "Results ";
              }
              //for each row, display info
              while($stmt->fetch()){
                echo "<tr><td>" .$stamp. "<td>" .$username. "<td>" .$message. "<td>
                </tr>";
              }
            ?>
          </tbody>
       </table>   
      <footer>
      </footer>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src='js/ie10-viewport-bug-workaround.js'></script>
  </body>
</html>