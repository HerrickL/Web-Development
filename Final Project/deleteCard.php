<?php
	session_start();
	include 'extra.php';
	//prepared statement to verify db
	$usersDB = new mysqli($myURL, $myDataBase, $myPassword, $myDataBase);
	if ($usersDB->connect_errno) {
	    echo http_response_code(200);
	}

	if(isset($_POST)){
		$post_cName = $_POST['cardName'];

		$delete = $usersDB->prepare("DELETE FROM ".$_SESSION['username']." WHERE CardName = ?");
		$delete->bind_param('s', $post_cName);
		if(!$delete->execute()){
			echo http_response_code(200);
		}
	}
	else{
		echo http_response_code(200);
	}

	echo "Deleted card";
?>