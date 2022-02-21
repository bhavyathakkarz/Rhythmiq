<?php
include '../../connection.php';
if(isset($_POST['songId'])){
	$songId=$_POST['songId'];
}
$squery="select * from songs where id='$songId'";
$query=mysqli_query($conn,$squery);
$resarray=mysqli_fetch_array($query);
echo json_encode($resarray);
?>