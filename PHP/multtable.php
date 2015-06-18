<?php
echo '<!DOCTYPE html>
<head>
  <meta charset="utf-8" />
   <title></title>
 </head>
 <body>';

 //variables
$minMulta = null;
$maxMulta = null;
$minMultp = null;
$maxMultp = null;
$errorMulta = null;
$errorMultp = null;
$errorMissing = null;
$errorNotInt = null;
$isError = false;

//GET information
foreach($_GET as $key => $value){
 	//echo '<tr><td>' . $key . '<td>' . $value;

 	if($key == "min-multiplicand"){
 		$minMulta = $value;
 		//echo '<tr><td>minMulta<td>' . $minMulta;
 	}
 	else if($key == "max-multiplicand"){
 		$maxMulta= $value;
 		//echo '<tr><td>maxMulta<td>' . $maxMulta;
 	}
 	else if($key == "min-multiplier"){
 		$minMultp = $value;
 		//echo '<tr><td>minMultp<td>' . $minMultp;
 	}
 	else if($key == "max-multiplier"){
 		$maxMultp = $value;
 		//echo '<tr><td>maxMultp<td>' . $maxMultp;
 	}
}

//if GET information, start validation and build table
if($minMulta && $maxMulta && $minMultp && $maxMultp){

	//validate input
	if(is_numeric($minMulta) && is_numeric($maxMulta) && is_numeric($minMultp) && is_numeric($maxMultp)){

		if((int)$minMulta <= (int)$maxMulta){

			if((int)$minMultp <= (int)$maxMultp){
				
				//create table
				echo '<p><h2>GET Multiplication Table</h2>
				<p>
	  			<table border = "1">
	  			<thead>
	  			<tr>
	  			<th></th>';

	  			//create table head for multiplicands
	  			for($index = (int)$minMultp; $index <= (int)$maxMultp; $index++){
	  				echo '<th>' . $index . '</th>';
	  			}
	  			echo '</tr></thead>
	  			<tbody>
	  			<tr>';

	  			//create rows heads (multipliers) and solutions
	  			for($row = (int)$minMulta; $row <= $maxMulta; $row++){
	  				
	  				$collumn = (int)$minMultp;

	  				echo '<th>' . $row;
	  				
	  				for($cell = 1; $cell <= ((int)$maxMultp - (int)$minMultp) + 1; $cell++){

	  					$result = $row * $collumn;
	  					//print row head
	  					echo '<td>' . $result . '</td>';

	  				  	//update multiplicand
	  					$collumn += 1;
	  				}

	  				echo '</tr>';
	  			}

				echo '</table>';
			}
			else{

				//error: multipliers aren't correct min max
				$errorMultp = "Minimum multiplier larger than maximum. ";
				$isError = true;
			}
		}
		else{

			//error: multiplicands are not correct min max
			$errorMulta = "Minimum multiplicand larger than maximum. ";
			$isError = true;
		}
	}
	//not numeric input
	else{
		if(!is_numeric($minMulta)){
			$errorNotInt .= "min-multiplicand must be an integer. ";
			$isError = true;
		}
		if(!is_numeric($maxMulta)){
			$errorNotInt .= "max-multiplicand must be an integer. ";
			$isError = true;
		} 
		if(!is_numeric($minMultp)){
			$errorNotInt .= "min-multiplier must be an integer. ";
			$isError = true;
		} 
		if(!is_numeric($maxMultp)){
			$errorNotInt .= "max-multiplier must be an integer. ";
			$isError = true;
		}
	}
} 
//error, not all variables
else {

	if($maxMultp == null){
		$errorMissing .=  "Missing max-multiplier. ";
		$isError = true;
	}

	if($maxMulta == null){
		$errorMissing .= "Missing max-multiplicand. ";
		$isError = true;
	}

	if($minMultp == null){
		$errorMissing .= "Missing min-multiplier. "; 
		$isError = true;
	}
	if($minMulta == null){
		$errorMissing .= "Missing min-multiplicand. ";
		$isError = true;
	}
}

 //if errors, display message
if($isError){
	echo '<p><h3>GET Variables</h3>
	<p>';
	if($errorMissing){
		echo '<p>' . $errorMissing . '</p>';
	}
	if($errorMulta){
		echo '<p>' . $errorMulta . '</p>';
	}
	if($errorMultp){
		echo '<p>' . $errorMultp . '</p>';
	}
	if($errorNotInt){
		echo '<p>' . $errorNotInt . '</p>';
	}
}

 echo '</body>
 </html>';
 ?>