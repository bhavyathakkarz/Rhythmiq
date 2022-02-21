<?php include 'includes/includedFile.php'; 
if(isset($_GET['id'])){
	$id=$_GET['id'];
}
else{
	header("location:index.php");
}
$album=new Album($conn,$id);
$artist=$album->getartist();
// echo $album->getTitle() . "<br>";
// echo $artist->getname();
?>
<div class="topinfo">
	<div id="leftsection">
		<img src="<?php echo $album->getartworkpath(); ?>">
	</div>
	<div id="rightsection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p role='link' tabindex="0" onclick="openPage('artist.php?id=<?php echo $artist->getid(); ?>')">By <?php echo $artist->getname(); ?></p>
		<p><?php echo $album->getnoofsongs(); ?> songs</p>
	</div>
</div>

<div class="songslist">
	<ul class="songs">
		<?php 
			$getid=$album->getsongid();
			$i=1;
			foreach ($getid as $id) {
				$albumSong=new song($conn,$id);
				$artist=$albumSong->getartist();
				echo "<li class='tracklistrow'>
					  	<div class='trackcount'>
					  		<img src='assets/images/icons/play-white.png' onclick='setTrack(\"".$albumSong->getId()."\",tempPlaylist,true);'>
					  		<span>$i</span>
					  	</div>
					  	<div class='trackinfo'>
					  		<span class='album'>".$albumSong->getTitle()."</span>
					  		<span class='artist'>".$artist->getname()."</span>
					  	</div>
					  	<div class='trackmore'>
					  		<input type='hidden' class='songId' value='".$albumSong->getId()."'>
					  		<img src='assets/images/icons/more.png' class='optionbtn' onclick='showOptionMenu(this)'>
					  	</div>
					  	<div class='trackduration'>
					  		<span>".$albumSong->getduration()."</span>
					  	</div>
					  
					  </li>";
				$i++;
			}

		?>
		<script>
			var songId='<?php echo json_encode($getid); ?>';
			tempPlaylist=JSON.parse(songId);
			console.log(tempPlaylist);
		</script>
	</ul>
</div>
<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropDown($conn,$userloggedin->getUsername()); ?>
</nav>

