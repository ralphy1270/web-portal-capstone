$(document).ready(function() {

	
	$('#request_botton_user').click(function(){
		
		$.ajax({
			type: "POST",
			url: "includes/handlers/ajax_send_applicants_request.php",
			data: $('form.request_user').serialize(),
			success: function(msg) {
				location.reload();
				alert('Request Sent');
			},
			error: function() {
				alert('Failure');
			}
		});

	});

});

function getDropdownDataRequest(user, type) {
	var user_loggedIn = user;
	if(user_loggedIn == ""){
		  alert("Login Account First!");
	}
	else{

		if(type == "request"){
			if($(".message_box").css("display") == "none") {
				$(".message_box").css({"padding" : "0px", "display": "block", "border" : "1px solid #DADADA","box-shadow" : "0 0 0.4rem rgba(0, 0, 0, .5)"});
				$(".submitforms_box").css({"padding" : "0px", "display": "none", "border" : "none" ,"box-shadow" : "none"});
			}
			else {
				$(".message_box").css({"padding" : "0px", "display": "none", "border" : "none" ,"box-shadow" : "none"});
			}
		}
		else if(type == "submitforms"){
			if($(".submitforms_box").css("display") == "none") {
				$(".submitforms_box").css({"padding" : "0px", "display": "block", "border" : "1px solid #DADADA","box-shadow" : "0 0 0.4rem rgba(0, 0, 0, .5)"});
				$(".message_box").css({"padding" : "0px", "display": "none", "border" : "none" ,"box-shadow" : "none"});
			}
			else {
				$(".submitforms_box").css({"padding" : "0px", "display": "none", "border" : "none" ,"box-shadow" : "none"});
			}
		}
		else {

		}
		
	}
	

}
