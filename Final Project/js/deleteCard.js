//iterate through delete buttons, creating click functions
var buttons = document.getElementsByName("delete");
var stop = false;
for(i=0; i< buttons.length; i++){
	buttons[i].onclick = function(){
		var stop = true;
		var name = this.id;
		console.log(name);
		//ajax, delete
		$.ajax({
			type: "POST",
			url: "deleteCard.php",
			data: 'cardName='+ name,
			dataType: "html",
			success: function(data){
				if(data == 0){
					$('.errormess').html('Could not delete this card from your deck.'); 
				}
				else{
					//redirect to home page
					document.location.href = 'userHome.php'; 
				}

			}
		});
	}
}
