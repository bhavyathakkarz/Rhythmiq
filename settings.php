<?php 
include 'includes/includedFile.php';
?>
<div class="userDetails">
	<div class="container borderBottom">
		<h2>USERNAME</h2>
		<input type="text" name="username" class="new_username" placeholder="Username..." value="<?php echo $userloggedin->getUsername(); ?>">
		<span class="message"></span>
		<button class="deletebtn save" onclick="updateUsername('new_username');">SAVE</button>
	</div>
	<div class="container">
		<h2>PASSWORD</h2>
		<input type="password" name="oldpassword" class="oldpassword" placeholder="Old Password...">
		<input type="password" name="newpassword" class="newpassword" placeholder="New Password...">
		<input type="password" name="cpassword" class="cpassword" placeholder="Confirm Password...">
		<span class="message"></span>
		<button class="deletebtn save" onclick="updatePassword('oldpassword','newpassword','cpassword');">SAVE</button>
	</div>
</div>