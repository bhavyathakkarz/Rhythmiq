<?php 
include '../../connection.php';
if(isset($_POST['playlistId'])){
	$playlistid=$_POST['playlistId'];

	mysqli_query($conn,"Delete from playlists where id='$playlistid'");
	mysqli_query($conn,"Delete from playlistsongs where playlistId='$playlistid'");
}
?>