<?php 
include '../../connection.php';
if(isset($_POST['playlistname']) and isset($_POST['username'])){
	$playlistname=$_POST['playlistname'];
	$username=$_POST['username'];
	$date=date("Y-m-d");
	$iquery="INSERT INTO playlists(name,owner,datecreated) values ('$playlistname','$username','$date')";
	$qry=mysqli_query($conn,$iquery);
}
else{
	echo "Name or username parameter not passed into file";
}
?>