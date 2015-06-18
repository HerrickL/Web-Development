<?php
	session_start();
	if(isset($_POST)){
		$_SESSION["cardType"] = $_POST["cardType"];
		$_SESSION["cardName"] = null;
		$_SESSION["cardColor"] = null;
		echo $_SESSION["cardType"];
	}
?>