<?php 
include '../../connection.php';
if(!isset($_POST['old_username']) or !isset($_POST['old_username'])){
	echo "ERROR:Could not set username";
	exit();
}
if(isset($_POST['old_username']) and isset($_POST['new_username']) and $_POST['new_username']!=""){
	$old_username=$_POST['old_username'];
	$new_username=$_POST['new_username'];

	$squery="select username from users where username='$new_username'";
	$chckqry=mysqli_query($conn,$squery);
	$count=mysqli_num_rows($chckqry);
	if($count==0){
		$uquery="update users set username='$new_username' where username='$old_username'";
		$query=mysqli_query($conn,$uquery);
		if($query){
			echo "Updated Successfully!!";
		}
		else{
			echo "Something went wrong.Try again later!!";
		}
	}
	else{
		echo "Username Already Exists";
	}

}
else{
	echo "You must provide an username";
}
?>