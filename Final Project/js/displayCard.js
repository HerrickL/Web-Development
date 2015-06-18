//loaded after php
document.getElementById("addButton").onclick = function(){
	var name = document.getElementById('cardName').innerText;
	var type = document.getElementById('cardType').innerText;
	var cost = document.getElementById('cardCost').innerText;
	var amount = document.getElementById('numCards').value;
	
	//for firefox
	if(name == null){
		var name = document.getElementById('cardName').textContent;
		var type = document.getElementById('cardType').textContent;
		var cost = document.getElementById('cardCost').textContent;
	}
	//if user doesn't select the amount input 
	if(amount == null || amount == 0){
		amount = 1;
	}
	//ajax to php, redirect if no probs
	$.ajax({
		type: "POST",
		url: "cardToDeck.php",
		data: 'cardName='+name+'&cardType='+type+'&cardCost='+cost+'&cardAmount='+amount,
		dataType: "html",
		success: function(data){
			console.log(data);
			if(data == 0){
				$('.errormess').html('Could not add this card to your deck.'); 
			}
			else{
				//redirect to home page
				document.location.href = 'userHome.php'; 
			}
		}
	});
}

