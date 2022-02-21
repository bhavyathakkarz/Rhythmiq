<?php include 'includes/includedFile.php'; 
if(isset($_GET['id'])){
	$playlistid=$_GET['id'];
}
else{
	header("location:index.php");
}
$playlist=new Playlist($conn,$playlistid);
$owner=new User($conn,$playlist->getOwner());
// echo $album->getTitle() . "<br>";
// echo $artist->getname();
?>
<div class="topinfo">
	<div id="leftsection">
		<div class="playlistimg">
			<img src="assets/images/icons/playlist.png" style="width:100%;">
		</div>
	</div>
	<div id="rightsection">
		<h2><?php echo $playlist->getName(); ?></h2>
		<p>By <?php echo $playlist->getOwner(); ?></p>
		<p><?php echo $playlist->getnoofsongs(); ?> songs</p>
		<button class="deletebtn" onclick="deletePlaylist('<?php echo $playlistid; ?>');">DELETE PLAYLIST</button>
	</div>
</div>

<div class="songslist">
	<ul class="songs">
		<?php 
			$getid= $playlist->getsongid();
			$i=1;
			foreach ($getid as $id) {
				$playlistSong=new song($conn,$id);
				$artist=$playlistSong->getartist();
				echo "<li class='tracklistrow'>
					  	<div class='trackcount'>
					  		<img src='assets/images/icons/play-white.png' onclick='setTrack(\"".$playlistSong->getId()."\",tempPlaylist,true);'>
					  		<span>$i</span>
					  	</div>
					  	<div class='trackinfo'>
					  		<span class='album'>".$playlistSong->getTitle()."</span>
					  		<span class='artist'>".$artist->getname()."</span>
					  	</div>
					  	<div class='trackmore'>
					  		<input type='hidden' class='songId' value='".$playlistSong->getId()."'>
					  		<img src='assets/images/icons/more.png' class='optionbtn' onclick='showOptionMenu(this)'>
					  	</div>
					  	<div class='trackduration'>
					  		<span>".$playlistSong->getduration()."</span>
					  	</div>
					  
					  </li>";
				$i++;
			}

		?>
		<script>
			var songId='<?php echo json_encode($getid); ?>';
			console.log(songId);
			tempPlaylist=JSON.parse(songId);
			console.log(tempPlaylist);
		</script>
	</ul>
</div>
<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropDown($conn,$userloggedin->getUsername()); ?>
	<div class="item" role="link" tabindex="0" onclick="removeFromPlaylist(this,'<?php echo $playlistid; ?>');">Remove From playlist</div>
</nav>