<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
header('Content-type: text/plain');


//class for GET or POST objects
class dataObj {
	function __construct($type, $parameters){
		$this->type = $type;
		$this->parameters = $parameters;
	}

	public $type;
	public $parameters;
}

//validate if GET
if(isset($_GET)){

	$paramArr = array();

	//store key as index and value as value in array
	foreach($_GET as $key => $value){
		
		$paramArr[$key] = $value;
	}

	//check if no key/values passed
	if($paramArr == null){
		$gpObj = new dataObj('GET', null);
	}
	//else pass array as second param in new obj
	else{
		$gpObj = new dataObj('GET', $paramArr);
	}
}
//validate if POST
else if(isset($_POST)){

	$paramArr = array();

	//array where index is key and value is value at index
	foreach($_POST as $key => $value){
		
		$paramArr[$key] = $value;
	}

	//check if no key/values passed
	if($paramArr == null){
		$gpObj = new dataObj('POST', null);
	}
	//else pass array as second param
	else{
		$gpObj = new dataObj('POST', $paramArr);
	}
}

//return json rep of object
echo json_encode($gpObj);

?>