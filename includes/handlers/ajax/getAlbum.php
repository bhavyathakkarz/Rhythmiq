<?php 
include '../../connection.php';
if(isset($_POST['albumId'])){
	$albumId=$_POST['albumId'];
}
$squery="select * from albums where id='$albumId'";
$query=mysqli_query($conn,$squery);
$resarray=mysqli_fetch_array($query);
echo json_encode($resarray);
?>