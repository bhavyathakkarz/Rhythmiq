<?php
include 'includes/connection.php';
include 'includes/classes/account.php';
include 'includes/classes/constants.php';
$account=new account($conn);
include 'includes/handlers/register-handler.php';
include 'includes/handlers/login-handler.php';


function isget($text){
	if(isset($_POST[$text])){
		echo $_POST[$text];
	}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Spotify</title>
	<link rel="stylesheet" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php 
	if(isset($_POST['submit'])){
		echo '<script>
				$(document).ready(function(){
					$("#loginform").hide();
					$("#registerform").show();
				});
			</script>';
	}
	else{
		echo '<script>
				$(document).ready(function(){
					$("#loginform").show();
					$("#registerform").hide();
				});
			</script>';
	}
	?>
	<div id="background">
		<div id="input-form">
			<div id="container">
				<form method="POST" action="register.php" id="loginform" style="display:none">
					<h2>Login To Your Account</h2>
					<p>
						<?php echo $account->geterror(constants::$loginfail); ?>
						<?php echo $account->geterror(constants::$unfail); ?>
						<label for="username">Username</label>
						<input type="text" id="lgusername" name="lgusername" placeholder="e.g.bhavyaThakkar" value="<?php isget('lgusername')?>" required>
					</p>
					<p>
						<label for="password">Password</label>
						<input type="password" id="lgpassword" name="lgpassword" placeholder="Your Password" required>
					</p>
						<input type="submit" value="LOGIN" name="lgsubmit">
						<div class="showhide">
							<span id="showregister">Don't have an account yet? Signup here.</span>
						</div>
				</form>
				<form action="register.php" method="POST" id="registerform" style="display:none;">
					<h2>Create Your Free Account</h2>
					<p>
						<?php echo $account->geterror(constants::$uname); ?>
						<?php echo $account->geterror(constants::$untaken); ?>
						<label for="username">Username</label>
						<input type="text" id="username" name="username" placeholder="e.g.bhavyaThakkar" value="<?php isget('username')?>" required>
					</p>
					<p>
						<?php echo $account->geterror(constants::$fname); ?>
						<label for="fname">First Name</label>
						<input type="text" id="fname" name="fname" placeholder="e.g.Bhavya" value="<?php isget('fname')?>" required>
					</p>
					<p>
						<?php echo $account->geterror(constants::$lname); ?>
						<label for="lname">Last Name</label>
						<input type="text" id="lname" name="lname" placeholder="e.g.Thakkar" value="<?php isget('lname')?>" required>
					</p>
					<p>
						<?php echo $account->geterror(constants::$pass1); ?>
						<?php echo $account->geterror(constants::$pass2); ?>
						<?php echo $account->geterror(constants::$pass3); ?>
						<label for="password">Password</label>
						<input type="password" id="password" placeholder="Your Password" name="password">
					</p>
					<p>
						<label for="cpassword">Confirm Password</label>
						<input type="password" id="cpassword" placeholder="Your Password" name="cpassword">
					</p>
					<p>
						<?php echo $account->geterror(constants::$email);?>
						<?php echo $account->geterror(constants::$emtaken); ?>
						<label for="email">Email</label>
						<input type="email" id="email" name="email" placeholder="e.g.bhavya@gmail.com" value="<?php isget('email')?>" required>
					</p>
						<input type="submit" value="SIGN UP" name="submit">
						<div class="showhide">
							<span id="showlogin">Already have an account? Log in here.</span>
						</div>
				</form>
			</div>
			<div id="logintext">
				<h1>Get great music, right now</h1>
				<h2>Listen to lots of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Create your own playlists</li>
					<li>Follow artists to keep up to date</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>