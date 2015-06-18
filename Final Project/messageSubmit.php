<?php
	session_start();
	include 'extra.php';

	//prepared statement to verify db
	$usersDB = new mysqli($myURL, $myDataBase, $myPassword, $myDataBase);
	if ($usersDB->connect_errno) {
	    // did not fail based off of user error
	    echo "Cannot connect to the database at this time. ";
	}
	//get post info
	if(isset($_POST)){
		$username = $_SESSION['username'];
		$post_mess = $_POST['message'];
		//error checking
		if($username == null || $post_mess == null){
			echo null;
			die($username." ".$message);
		}
		//access db
		if (!($stmt = $usersDB->prepare("INSERT INTO messageboard(username, message) VALUES (?, ?)"))) {
			//fail back to js/ajax;
			echo null;
			die("prepare ");
		}
		/* bind data */
		/* Prepared statement, stage 2: bind and execute. From PHP manual */
		if (!$stmt->bind_param("ss", $username, $post_mess)) {
			//fail back to js/ajax
			echo null;
			die("bind ");
		}
		if (!$stmt->execute()) {
			 //faill back to js/ajax
			echo null;
			die("execute ");
		}
	}
	else{
		echo null;
		die("post ");
	}
	echo "Message added successfully.";
?>