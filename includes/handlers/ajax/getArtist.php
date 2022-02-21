<?php 
include '../../connection.php';
if(isset($_POST['artistId'])){
	$artistId=$_POST['artistId'];
}
$squery="select * from artist where id='$artistId'";
$query=mysqli_query($conn,$squery);
$resarray=mysqli_fetch_array($query);
echo json_encode($resarray);
?>