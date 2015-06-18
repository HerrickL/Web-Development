//variations of card search
$(function(){
	//name search
	$("#nameSearch").click(function(){
		//set variables
		var name = $("input#cardName").val();
		//name can't be blank or null
		if(name == ""){
			$('.errormess').html('You must enter a card name.');
		}	
		//get card
		getCard(name);
	});
	//type search
	$("#typeSearch").click(function(){
		//set variables
		var type = $("input#cardType").val();
		//type can't be blank or null
		if(type == ""){
			$('.errormess').html('You must enter a card type.');
		}
		//http://api.mtgdb.info/cards/?types=
		getByType(type);
	});
	//color search
	$("#colorSearch").click(function(){
		//set variables

		var colors;
		if($("input#red").is(':checked')){
			colors = "R";
		}
		if($("input#blue").is(':checked')){	
			colors = "U";
		}
		if($("input#green").is(':checked')){
			colors = "G";
		}
		if($("input#black").is(':checked')){
			colors = "B";
		}
		if($("input#white").is(':checked')){
			colors = "W";
		}
		//colors can't be blank or null
		if(!colors){
			$('.errormess').html('You must select a color.');
		}
		//api.mtgdb.info/cards/?colors
		getByColor(colors);


	});
});


function getCard(name){
	var cardName;
	var found = false;
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","cards/cards.xml",false);
	xmlhttp.send();
	xmlDoc=xmlhttp.responseXML;
	var cards=xmlDoc.getElementsByTagName("cards");
	//get all cards
	for(i = 0; i < cards.length; i++){
		//get individual card
		var card= cards[i].getElementsByTagName("card")
		for(j = 0; j < card.length; j++ ){
			//found it, display data
			if(card[j].getElementsByTagName("name")[0].childNodes[0].nodeValue == name){
				//card info for display
				var found = true;
				var cardName = card[j].getElementsByTagName("name")[0].childNodes[0].nodeValue;	
				//redirect
				sendCard(cardName);
			}
		}
	}
	if(!found){
		$('.errormess').html('A card by that name cannot be found.');
	}
}

function sendCard(name){
	//redirect
	$.ajax({
		type: "POST",
		url: "cardRedirect.php",
		data: 'cardName='+ name,
		dataType: "html",
		success: function(data){
			if(data == 0){
				$('.errormess').html('Could not redirect to results.'); 
			}
			else{
				//redirect
				document.location.href = 'displayResult.php'; 
			}
		}
	});
	
}


function getByType(type){
	var found = false;
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","cards/cards.xml",false);
	xmlhttp.send();
	xmlDoc=xmlhttp.responseXML;
	var cards=xmlDoc.getElementsByTagName("cards");
	//get all cards
	for(i = 0; i < cards.length; i++){
		//get individual card
		var card= cards[i].getElementsByTagName("card")
		for(j = 0; j < card.length; j++ ){
			//found it, display data
			if(card[j].getElementsByTagName("type")[0].childNodes[0].nodeValue == type){
				//card info for display
				var found = true;
				//no neede to keep checking
				j = card.length;
				i = cards.length;
			}
		}
	}
	if(!found){
		$('.errormess').html('A card of that type cannot be found.');
	}
	else{
		//redirect
		$.ajax({
			type: "POST",
			url: "cardRedirectT.php",
			data: 'cardType='+ type,
			dataType: "html",
			success: function(data){
				if(data == 0){
					$('.errormess').html('Could not redirect to results.'); 
				}
				else{
					//redirect
					document.location.href = 'displayResult.php'; 
				}
			}
		});
	}
}

function getByColor(color){
	//redirect
	$.ajax({
		type: "POST",
		url: "cardRedirectc.php",
		data: 'cardColor='+color,
		dataType: "html",
		success: function(data){
			if(data == 0){
				$('.errormess').html('Could not redirect to results.'); 
			}
			else{
				//redirect
				document.location.href = 'displayResult.php'; 
			}
		}
	});
}

