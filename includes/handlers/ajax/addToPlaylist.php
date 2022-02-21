<?php
include '../../connection.php';
if(isset($_POST['playlistId']) and isset($_POST['songId'])){
	$playlistid=$_POST['playlistId'];
	$songid=$_POST['songId'];
	$orderquery=mysqli_query($conn,"select max(playlistOrder)+1 as playlistOrder from playlistsongs where playlistId='$playlistid'");
	$row=mysqli_fetch_array($orderquery);
	$order=$row['playlistOrder'];
	$iquery=mysqli_query($conn,"insert into playlistsongs(songsId,playlistId,playlistOrder) values ('$songid','$playlistid','$order')");
}
else{
	echo "Not set";
}



?>
