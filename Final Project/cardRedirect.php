<?php
	session_start();
	if(isset($_POST)){
		$_SESSION["cardName"] = $_POST["cardName"];
		$_SESSION["cardColor"] = null;
		$_SESSION["cardType"] = null;
		echo $_SESSION["cardName"];
	}
?>