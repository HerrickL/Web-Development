<?php

/*code below inside first condition statement is a modified version 
of code given in cs 290 lecture titled "PHP Sessions"*/

session_start();

//validate they can be here
if(!isset($_SESSION['username'])){
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
else{

	echo 'If you would like to go to page 1, click <a href="content1.php">here</a>.';
}
?>