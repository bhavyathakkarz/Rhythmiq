<?php include 'includes/includedFile.php'; 
if(isset($_GET['id'])){
	$id=$_GET['id'];
}
else{
	header("location:index.php");
}
$artist = new Artist($conn,$id);
?>

<div class="topinfo borderbottom">
	<div id="centersection">
		<div id="artistinfo">
			<h1><?php echo $artist->getname(); ?></h1>
			<div class="headerbutton">
				<button class="playbtn" onclick="playFirst();">PLAY</button>
			</div>
		</div>
	</div>
</div>
<div class="songslist borderbottom">
	<h1>Songs</h1>
	<ul class="songs">
		<?php 
			$getid=$artist->getsongid();
			$i=1;
			foreach ($getid as $item) {
				// echo $id;
				if($i>5){
					break;
				}
				$albumSong=new song($conn,$item);
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
<div id="gridview">
	<h1>Album</h1>
	<?php 
	$s="select * from albums where artist='$id'";
	$query=mysqli_query($conn,$s);
	while($row=mysqli_fetch_array($query)){
		// echo $row['title'] . "<br/>";

		echo "<div class='gridviewitem'>
			  <span  role='link' tabindex='0' onclick='openPage(\"album.php?id=".$row['id']."\");'>
				<img src='".$row['artworkpath']."'>
				<div class='gridviewinfo'>
					".$row['title']."
				</div>
			  </span>
			  </div>";
	}
	?>
</div>
<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<?php echo Playlist::getPlaylistsDropDown($conn,$userloggedin->getUsername()); ?>
</nav>





