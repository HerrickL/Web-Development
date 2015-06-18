<?php
	session_start();
	include 'extra.php';
	$_SESSION['username'] = null;
   //prepared statement to verify db
	$usersDB = new mysqli($myURL, $myDataBase, $myPassword, $myDataBase);
	if ($usersDB->connect_errno) {
	    echo "Could not connect to the database at this time";
	}
	//check if username exists
	if(isset($_POST)){
		$post_username = $_POST['username'];
		$post_password = $_POST['password'];
	
		//prepare
		if(!($stmt = $usersDB->prepare("SELECT * FROM users WHERE username = ? && password = ?"))){
			echo null;
			die();
		}
		if(!$stmt->bind_param('ss', $post_username, $post_password)){
			echo null;
			die();
		}
		if(!$stmt->execute()){
			echo null;
			die();
		}
		$stmt->store_result();
		if($stmt->num_rows <= 0){
			echo null;
			die();
		}
		//found
		else{
			$_SESSION['username'] = $post_username;
			echo $_SESSION['username'];
		}
	}
	else{
		echo null;
	}	
?>