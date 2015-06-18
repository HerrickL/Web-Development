$(function(){
	//message submit button clicked
	$("#messSubmit").click(function(){
		//get text inside textarea
		var message = document.getElementById("uMessage").value;
		console.log(message);
		//message requires text
		if(message != ""){
			console.log("click");
			//redirect
			$.ajax({
				type: "POST",
				url: "messageSubmit.php",
				data: 'message='+ message,
				dataType: "html",
				success: function(data){
					console.log(data);
					if(data == 0){
						$('.errormess').html('Could not submit message at this time.'); 
					}
					else{
						//redirect for updated message list
						document.location.href = 'messageBoard.php'; 
					}
				}
			});
		}
		else{
			$('.errormess').html('You must enter some text to submit a message. '); 
		}

	});
});