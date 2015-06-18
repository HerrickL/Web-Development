<?php
	session_start();
	if(isset($_POST)){
		$_SESSION["cardColor"] = $_POST["cardColor"];
		$_SESSION["cardName"] = null;
		$_SESSION["cardType"] = null;
		echo $_SESSION["cardColor"];
	}
?>