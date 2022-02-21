<?php
// include 'includes/connection.php';
if(isset($_POST['lgsubmit'])){
	$username=$_POST['lgusername'];
	$password=$_POST['lgpassword'];
	$result=$account->login($username,$password);
	if($result){
		$_SESSION['login']=$username;
		header('Location:index.php');
	}

}
?>