<?php 
include '../../connection.php';
if(isset($_POST['playlistId']) and isset($_POST['songId'])){
	$playlistid=$_POST['playlistId'];
	$songid=$_POST['songId'];
	mysqli_query($conn,"Delete from playlistsongs where playlistId='$playlistid' and songsId='$songid'");
}
?>