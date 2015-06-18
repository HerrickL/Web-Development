<?php
	session_start();
	include 'extra.php';
	//prepared statement to verify db

	$usersDB = new mysqli($myURL, $myDataBase, $myPassword, $myDataBase);
	if ($usersDB->connect_errno) {
	    echo http_response_code(200);
	}
	//get post data and put it in the user's deck
	if(isset($_POST)){
		$post_cName = $_POST['cardName'];
		$post_cType = $_POST['cardType'];
		$post_cCost = $_POST['cardCost'];
		$post_cAmount = $_POST['cardAmount'];
		//error checking
		if($post_cName == null){
			echo http_response_code(200);
			die("card name ");
		}
		if($post_cType == null){
			echo http_response_code(200);
			die("card type ");
		}
		if($post_cCost == null){
			echo http_response_code(200);
			die("card cost ");
		}
		if($post_cAmount == null){
			echo http_response_code(200);
			die("card amount ");
		}
		//add to deck
		if (!($stmt = $usersDB->prepare("INSERT INTO ".$_SESSION['username']."(CardName, CardType, CardCost, Amount) VALUES (?, ?, ?, ?)"))) {
			//echo http_response_code(200);
			die("prepare: ".$_SESSION['username'] );
			echo http_response_code(200);
		}

		if (!$stmt->bind_param("sssi", $post_cName, $post_cType, $post_cCost, $post_cAmount)) {
			//echo http_response_code(200);
			die(" bind: ".$_SESSION['username'] );
			echo http_response_code(200);
		}
		if (!$stmt->execute()) {
			 //echo http_response_code(200);
			die(" execute: ".$_SESSION['username']);
			echo http_response_code(200);
		}
		else{
			echo "Added card";
		}
	}

?>