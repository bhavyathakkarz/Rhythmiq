<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
	include 'includes/connection.php';
	include 'includes/classes/User.php';
	include 'includes/classes/Playlist.php';
	include 'includes/classes/Artist.php';
	include 'includes/classes/Album.php';
	include 'includes/classes/song.php';
	// echo "Connected using ajax";
	if(isset($_GET['userloggedin'])){
		$userloggedin=new User($conn,$_GET['userloggedin']);
	}
	else{
		echo "Username not set";
		exit();
	}
}
else{
	include 'includes/header.php';
	include 'includes/footer.php';

	$url=$_SERVER['REQUEST_URI'];
	echo "<script>openPage('$url')</script>";
	exit();
}
?>