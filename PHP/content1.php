<?php
session_start();

/*code below inside first condition statement is a modified version 
of code given in OSU CS 290 lecture titled "PHP Sessions" about
how to read GET actions as a condition, end session, and redirect user*/

//if  GET action = logout exists (through logout link), logout
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
	//clear session data in array, destroy session (cookie, etc)
	$_SESSION = array();
	session_destroy();
	//parse the url for redirect
	//split string where there is a '/' and return array of data
	//take all but file name
	$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
	//combine array into a string and put '/' behind them (put it back together)
	$filePath = implode('/',$filePath);
	//append beginning and concat above string
	$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
	//write html header with location redirect link, true replaces any other existing header (should be none, but just in case)
	header("Location: {$redirect}/login.php", true);
	//kill the page, redirect
	die();
}
//if username was posted and no GET
else if(isset($_POST['username'])){
	
	$_SESSION['username'] = $_POST['username'];
}
//welcome back
else if(isset($_SESSION['username'])){

	//increment visits
	$_SESSION['visits']++;

}
//user shouldn't be here, redirect
else{

/*code below inside first condition statement is a modified version 
of code given in cs 290 lecture titled "PHP Sessions" this is also
cited above inside first condition.  For further notes, refer to above.*/
	$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
	$filePath = implode('/',$filePath);
	$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;

	//redirect user
	header("Location: {$redirect}/login.php", true);
	die();
}

//active session going, display info, get actions
if(session_status() == PHP_SESSION_ACTIVE){

	//validate username
	if($_SESSION['username'] != null)
	{
		//set or increment visits
		if(!isset($_SESSION['visits'])){
			$_SESSION['visits'] = 0;
		}

		//display info with logout option, if logout link clicked, set GET action
		echo "Hello $_SESSION[username], you have visited this page $_SESSION[visits] times before. 
		Click <a href= http://web.engr.oregonstate.edu/~herrickl/assignment4.1/content1.php?action=logout>
		here</a> to logout. <br><br>";

		echo 'If you would like to go to page 2, click <a href="content2.php">here</a>.';
	}
	//empty username was posted
	else{
		echo 'A username must be entered. Click <a href="login.php">here</a> to return to the login screen.';
	}
}


?>