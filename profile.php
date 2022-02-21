<?php 
include 'includes/includedFile.php';
?>
<div class="topinfo">
	<div id="centersection">
		<div class="userinfo">
			<h1 style="text-align:center;"><?php echo $userloggedin->getName(); ?></h1>
		</div>
		<div class="buttongroup">
			<button class="deletebtn" style="margin-bottom:30px;" onclick="openPage('settings.php')">USER DETAILS</button>
			<button class="deletebtn" style="margin-bottom:30px;" onclick="logout();">LOGOUT</button>
		</div>
	</div>
	
</div>