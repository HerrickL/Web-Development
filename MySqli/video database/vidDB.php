<?php

	//suggested code from video lecture to alert errors
	ini_set('display_errors', 'On');
	include 'storedInfo.php';

   //prepared statement to verify db
	$videoDB = new mysqli($myURL, $myDataBase, $myPassword, $myDataBase);
	if ($videoDB->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $videoDB->connect_errno . ") " . $videoDB->connect_error;
	}
?>


<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <title>Assignment 4 Part 2</title>
  </head>
  <body>
  	<h1><center> Welcome to the Movie Database </center></h1>
  	<br>
  	<br>
  	<!-- Add a movie -->
  	<form action = "vidDB.php" method ="post">
  	  <center>
  	  <h2>Add A Movie</h2>
  	  Name:
  	  <input type="text" name="name">
  	  Category:
  	  <input type="text" name="category">
  	  Length in Minutes:
  	  <input type="text" name ="length">
  	  <!--add button: when clicked ATTEMPTS (with validation) to add movie info to db table -->
  	  <input type="submit" name = "add" value ="add">
  	</center>
    </form>
    <br>
    <br>
    <br>
    <!-- DB Movies table will go here -->
    <h2><center> Movies in the Database </center></h2>
    <form action = "vidDB.php" name ="filters" method="post">
     <!--drop down menu for categories + all movies-->
     <center>Category: <select name="catFil">
      <!-- build category list based off of user input -->
<?php
	//variables
    $uName = NULL;
    $uCategory = NULL;
    $uLength = NULL;
    $uRented = false;
    $valAdd = false;
    $valDel = false;
    $valDelA = false;
    $filter = NULL;

	//add to table if post, based off of required input
	if(isset($_POST['add']) && ($_POST['name'] != NULL)){

		//validate length is empty or is number
		if(is_numeric($_POST['length']) || ($_POST['length'] == NULL)){
			
			//validate positive number length
			if($_POST['length'] >= 0){

				$uName = $_POST['name'];
			    $uCategory = $_POST['category'];
			    $uLength = $_POST['length'];
			    $uRented = false;
			    
			    /* Prepared statement, stage 1: prepare. From PHP manual */
				if (!($stmt = $videoDB->prepare("INSERT INTO movies(name, category, length, rented) VALUES (?, ?, ?, ?)"))) {
					echo "Prepare failed: (" . $videoDB->errno . ") " . $videoDB->error;
				}

			    /* bind data */
				/* Prepared statement, stage 2: bind and execute. From PHP manual */
				if (!$stmt->bind_param("ssib", $uName, $uCategory, $uLength, $uRented)) {
			    	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
				}

				//execute
				if (!$stmt->execute()) {
			   		if($stmt->errno == 1062){
			   			echo "Error: That title already exists.  You may not add a duplicate.<br><br>";
			   		}
			   		else{
			   			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error. "<br><br>";
			   		}
				}
				$stmt->close();
			}
		}
	}
	//singular delete button was pushed
	if(isset($_POST['delete'])){

		$dName = $_POST['delete'];
		$delete = "DELETE FROM movies WHERE name = \"".$dName."\"";

		//delete or notify error
		if(!$videoDB->query($delete)){
			echo "Error: was not able to delete entry. <br>";
		}	
	}
	//create filter menu and don't allow repeats 
	if(!isset($_POST['deleteAll'])){

		$select = "SELECT DISTINCT category FROM movies";
		$categories = $videoDB->query($select);

		if($categories->num_rows > 0){

			//option for all
			echo "<option value = 'all'>all</option>";
			while($row = $categories->fetch_assoc()){
			//create drop down option
				if($row["category"] != NULL){
					echo "<option value =\"".$row["category"]."\">".$row["category"]."</option>";
				}
			}
		}
	}
?>
  	  </select>
  	  <input type="submit" value ="Filter"></center>
    </form>
    <br>
    <table>
      <thead>
      	<tr>
          <th>Name</th>
          <th align = 'left'>Category</th>
          <th>Length</th>
          <th align = 'left'>Rented</th>
          <th>Check In/Out</th>
          <th>Delete</th>
        </tr>
      </thead>
    <!--display table of database data -->
    <?php
		//add button pushed with no title name
		if(isset($_POST['add']) && ($_POST['name'] == NULL)){
			echo "Error: You are required to enter a title name. <br><br>";
		}
		//add button was pushed with non-numeric length (not including null)
		if(isset($_POST['add']) && (!is_numeric($_POST['length'])) && ($_POST['length'] != NULL)){
			echo "Error: If you want to include a length, it must be a positive number only.<br><br>";
		}
		//add button was pushed and negative length entered
		if(isset($_POST['add']) && ($_POST['length'] < 0)){
			echo "Error: If you want to include a length, it must be a positive number only.<br><br>";
		}
		//delete all button was pushed
		elseif(isset($_POST['deleteAll'])){
			
			$delete = "DELETE FROM movies";
			if(!$videoDB->query($delete)){
				echo "Error: was not able to delete entries. <br>";
			}				
		}
		//singular check in/out clicked
		elseif(isset($_POST['checkout'])){

			//switch rented to the opposite (true/false) of itself
			$update = "UPDATE movies SET rented=(!rented) WHERE name=\"".$_POST['checkout']."\"";
			if(!$videoDB->query($update)){
				echo "Error: was not able to update rented status. <br>";
			}				
		}
		//prepare all db data
		if (!($stmt = $videoDB->prepare("SELECT name, category, length, rented FROM movies"))) {
		   	echo "Prepare failed: (" . $videoDB->errno . ") " . $videoDB->error;
		}
		//execute
		if (!$stmt->execute()) {
	   		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		//bind results
		if(!$stmt->bind_result($uName, $uCategory, $uLength, $uRented)){
			echo "Binding results failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		//prepare table body
		echo "<tbody>";

		//filter button is pushed with specific filter
		if(isset($_POST['catFil']) && ($_POST['catFil']) != 'all'){

			while($stmt->fetch()){

				if($_POST['catFil'] == $uCategory){
					if ($uRented) {
						$rentStr = "checked out";
					}
					else{
						$rentStr = "available";
					}
					//show an empty space if no length entered
					if($uLength == NULL){
						$uLength = " ";
					}
					echo "<tr><td>" .$uName. "<td align = 'center'>" .$uCategory. "<td align = 'center'>" .$uLength. "<td align = 'center'>" .$rentStr. 
					"<td align = 'center'><form action = 'vidDB.php' name ='checkIOF' method='post'><input type='submit' name='checkout' value=\"".$uName."\"></form>
					<td align = 'center'><form action = 'vidDB.php' name = 'deleteF' method='post'><input type='submit' name= 'delete' value= \"".$uName."\"></form>
					</tr>";
				}
			}

		}
		//else, no filter
		else{

			//$display = $videoDB->query("SELECT name, category, length, rented FROM movies");
			while($stmt->fetch()){
				if ($uRented) {
					$rentStr = "checked out";
				}
				else{
					$rentStr = "available";
				}
				//show an empty space if no length entered
				if($uLength == NULL){
					$uLength = " ";
				}
				echo "<tr><td>" .$uName. "<td align = 'center'>" .$uCategory. "<td align = 'center'>" .$uLength. "<td align = 'center'>" .$rentStr. 
				"<td align = 'center'><form action = 'vidDB.php' name ='checkIOF' method='post'><input type='submit' name='checkout' value= \"".$uName."\"></form>
				<td align = 'center'><form action = 'vidDB.php' name = 'deleteF' method='post'><input type='submit' name= 'delete' value= \"".$uName."\"></form>
				</tr>";
			}
		}
		echo "</tbody>";

		//close statement
		$stmt->close();
    ?>
	</table>
	<br>
	<center><form action = 'vidDB.php' name = 'deleteA' method='post'><input type = 'submit' name = 'deleteAll' value='Delete All'></center>
  </body>
</html>
<?php
	//close db connection
	$videoDB->close();
?>