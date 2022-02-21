<?php
ob_start();
session_start();
$time=date_default_timezone_set("Asia/Kolkata");
$conn=mysqli_connect("localhost","root","","spotify");
?>