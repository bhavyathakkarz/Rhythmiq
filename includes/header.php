<?php
include 'includes/connection.php';
include 'includes/classes/User.php';
include 'includes/classes/Playlist.php';
include 'includes/classes/Artist.php';
include 'includes/classes/Album.php';
include 'includes/classes/song.php';
if(isset($_SESSION['login'])){
	$name=$_SESSION['login'];
	$userloggedin=new User($conn,$name);
	echo "<script>userLoggedIn='$name'</script>";
}
else{
	header("location:register.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Spotify</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script> -->
	<script src="assets/js/script.js"></script>
</head>
<body>
	<!-- <script type="text/javascript">
		window.onload({
			var audios=new Audio();
			audios.setTrack("assets/music/bensound-acousticbreeze.mp3");
		// audios.muted = true;
			audios.audio.play();

		})
	</script> -->
	<div id="maincontainer">
		<div id="topcontainer">
			<?php include 'includes/navbar.php' ?>
			<div id="mainview">
				<div id="maincontent">