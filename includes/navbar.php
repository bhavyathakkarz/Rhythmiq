<div id="navbarcontainer">
	<nav class="navbar">
		<span  role="link" tabindex="0" onclick="openPage('index.php');" class="logo">
			<img src="assets/images/icons/logo.png" alt="logo">
		</span>
		<div class="group">
			<div class="navitem">
				<span  role="link" tabindex="0" onclick="openPage('search.php');"  class="navitemlink">Search
					<img src="assets/images/icons/search.png" alt="search" class="search">
				</span>
			</div>
		</div>
		<div class="group">
			<div class="navitem">
				<span  role="link" tabindex="0" onclick="openPage('browse.php');" class="navitemlink">Browse</span>
			</div>
			<div class="navitem">
				<span  role="link" tabindex="0" onclick="openPage('yourmusic.php');"class="navitemlink">Your Music</span>
			</div>
			<div class="navitem">
				<span  role="link" tabindex="0" onclick="openPage('profile.php');" class="navitemlink"><?php echo $userloggedin->getName(); ?></span>
			</div>
		</div>
	</nav>
</div>