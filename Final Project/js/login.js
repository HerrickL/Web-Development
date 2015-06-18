
$(function(){
	$('.errormess').html('<br>');
	$('.errormess2').html('<br>');
	//login
	$("#loginBtn").click(function(){
		//set variables
		var username = $("input#inputUsername").val();
		//username can't be blank or null
		if(username == ""){
			$('.errormess').html('You must enter a username.');
			return false;
		}
		var password = $("input#inputPassword").val();
		//password can't be blank or null
		if(password == ""){
			$('.errormess').html('You must enter a password.');
			return false;
		}
		$.ajax({
			type: "POST",
			url: "login.php",
			data: 'username='+ username + '&password=' + password,
			dataType: "html",
			success: function(data){
				if(data == 0){
					$('.errormess').html('Invalid username or password.'); 
				}
				else{
					//redirect
					 document.location.href = 'userHome.php'; 
				}
			}
		});
		return false;
	});
	//registration
	$("#regBtn").click(function(){
		//set variables
		var username = $("input#regUsername").val();
		//username can't be blank or null
		if(username == ""){
			$('.errormess2').html('You must enter a username.');
			return false;
		}
		var password = $("input#regPassword").val();
		//password can't be blank or null
		if(password == ""){
			$('.errormess2').html('You must enter a password.');
			return false;
		}
		var email = $("input#regEmail").val();
		//password can't be blank or null
		if(email == ""){
			$('.errormess2').html('You must enter an email address.');
			return false;
		}
		$.ajax({
			type: "POST",
			url: "register.php",
			data: 'username='+ username + '&password=' + password + '&email=' + email,
			dataType: "html",
			success: function(data){
				if(data == 0){
					$('.errormess2').html('That username already is taken.'); 
				}
				else if(data == "Invalid email address"){
					$('.errormess2').html('Please enter a valid email address.'); 
				}
				else{
					//redirect
					 document.location.href = 'userHome.php';
				}
			}
		});
		return false;
	});

});
