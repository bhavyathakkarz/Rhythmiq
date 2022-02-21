<?php
include '../../connection.php';
if(isset($_POST['songId'])){
	$songId=$_POST['songId'];
}
$uquery="update songs set plays=plays+1 where id='$songId'";
$query=mysqli_query($conn,$uquery);
// $resarray=mysqli_fetch_array($query);
// echo json_encode($resarray);
?>