$(document).ready(function(){
	$("#showregister").click(function(){
		$("#loginform").hide();
		$("#registerform").show();
	});
	$("#showlogin").click(function(){
		$("#loginform").show();
		$("#registerform").hide();
	});

});