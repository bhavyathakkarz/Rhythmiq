<?php


function sanitizeFormPassword($text){
	$text=strip_tags($text);
	return $text;
}
function sanitizeFormUsername($text){
	$text=strip_tags($text);
	$text=str_replace(" ", "", $text);
	return $text;
}
function sanitizeFormString($text){
	$text=strip_tags($text);
	$text=str_replace(" ", "", $text);
	$text=ucfirst(strtolower($text));
	return $text;
}
// function validateusername($un){
// 	if($un<=2 || $un>20){
// 		array_push($this->errorarray,"username is too short or too long");
// 	}

// }
// function validatefname($fn){
// 	if($fn<=2 || $fn>20){
// 		array_push($this->errorarray,"Firstname is too short or too long");
// 	}

	
// }
// function validatelname($ln){
// 	if($ln<=2 || $ln>20){
// 		array_push($this->errorarray,"Lastname is too short or too long");
// 	}
	
// }
// function validatepassword($p,$cp){
// 	if($p!=$cp){
// 		array_push($this->errorarray,"Password doesn't match");
// 	}
// 	if($p<=5 || $p>=25){
// 		array_push($this->errorarray,"Password is too short or too long");
// 	}
// 	if(preg_grep('/[^A-Za-z0-9@#$%^&*()]/', input)){
// 		array_push($this->errorarray,"Password must contain one uppercase,one lowercase,one digit and one special character");
// 	}
// }
// function validateemail($e){
// 	if(!filter_var($e,FILTER_VALIDATE_EMAIL)){
// 		array_push($this->errorarray,"Enter valid email");
// 	}
	
// }
if(isset($_POST['submit'])){
	$username=sanitizeFormUsername($_POST['username']);
	$fname=sanitizeFormString($_POST['fname']);
	$lname=sanitizeFormString($_POST['lname']);
	$password=sanitizeFormPassword($_POST['password']);
	$cpassword=sanitizeFormPassword($_POST['cpassword']);
	$email=$_POST['email'];

	// validateusername($username);
	// validatefname($fname);
	// validatelname($lname);
	// validatepassword($password,$cpassword);
	// validateemail($email);
	$result=$account->register($username,$fname,$lname,$password,$cpassword,$email);
	if($result){ 
		header("location:register.php");
	}
	
}
?>