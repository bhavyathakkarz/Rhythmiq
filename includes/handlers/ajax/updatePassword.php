<?php 
include '../../connection.php';
if(!isset($_POST['username'])){
	echo "ERROR:Could not set username";
	exit();
}
if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword']) || !isset($_POST['cPassword'])){
	echo "Not all passwords have been set";
	exit();
}
if($_POST['oldPassword']=="" || $_POST['newPassword']=="" || $_POST['cPassword']==""){
	echo "Please fill in all fields";
	exit();
}

$username=$_POST['username'];
$oldPassword=$_POST['oldPassword'];
$newPassword=$_POST['newPassword'];
$cPassword=$_POST['cPassword'];
$squery="select * from users where username='$username'";
$query=mysqli_query($conn,$squery);
$count=mysqli_num_rows($query);
if($count){
	$row=mysqli_fetch_array($query);
	$chckpsswrd=$row['password'];
	if(!password_verify($oldPassword,$chckpsswrd)){
		echo "Previous Password is not correct";
		exit();
	}
	if($newPassword!=$cPassword){
		echo "Your new password do not match";
		exit();
	}
	if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $newPassword)){
		echo"Your Password must contain letters and/or numbers";
		exit();
	}
	if(strlen($newPassword)<5 || strlen($newPassword)>25){
		echo "Your password must be between 5 & 25 characters";
		exit();
	}
	$hpass=password_hash($newPassword, PASSWORD_BCRYPT);
	$uquery=mysqli_query($conn,"update users set password='$hpass' where username='$username' ");
	if($uquery){
		echo "Updated Successfully!!";
	}
	else{
		"Something Went Wrong";
	}
}
else{
	echo "No such User found";
}
?>