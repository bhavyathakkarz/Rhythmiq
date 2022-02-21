<?php
include 'includes/includedFile.php';
if(isset($_GET['term'])){
	$term=urldecode($_GET['term']);
}
else{
	$term="";
}
?>
<div class="searchcontainer">
	<h2>Search for an artist,album or song</h2>
	<input type="text"  id="search" class="searchinput" value="<?php echo $term; ?>" placeholder="Start Typing..." onfocus="this.value=this.value;">

</div>
<script>
	$(".searchinput").focus();
	$(function(){
		$(".searchinput").keyup(function(){
			clearTimeout(timer);
			timer=setTimeout(function(){
				var val=$(".searchinput").val();
				openPage("search.php?term="+val); 
			},2000);
		});
	});
</script>
<?php if($term=="") {exit();}?>
<div class="songslist borderbottom">
	<h1>Songs</h1>
	<ul class="songs">
			<?php 
			$searchq="select id from songs where title like '$term%'";
			$qry=mysqli_query($conn,$searchq);
			if(mysqli_num_rows($qry)==0){
				echo "<span class='noresult'>No songs found matching ". $term . "</span>";
			}
			$getid=array();
			$i=1;
			while($row=mysqli_fetch_array($qry)) {
				if($i>5){
					break;
				}
				array_push($getid,$row['id']);
				$albumSong=new song($conn,$row['id']);
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
<div class="artistcontainer borderbottom">
	<h1 style="text-align:center;">Artists</h1>
	<?php
	$artquery="select id from artist where name like '$term%'";
	$aqry=mysqli_query($conn,$artquery);
	if(mysqli_num_rows($aqry)==0){
		echo "<span class='noresult'>No artists found matching ".$term."</span>";
	}
	while($row=mysqli_fetch_array($aqry)){
		$artist=new Artist($conn,$row['id']);
		echo "<div class='searchresult'>
				<div class='artistname'>
					<span role='link' tabindex='0' onclick='openPage(\"artist.php?id=".$artist->getid()."\")'>".$artist->getname()."</span>
				</div>
			   </div>";

	}
	?>
</div>
<div id="gridview">
	<h1 style="text-align:center;">Album</h1>
	<?php 
	$s="select * from albums where title like '$term%'";
	$query=mysqli_query($conn,$s);
	if(mysqli_num_rows($qry)==0){
		echo "<span class='noresult'>No songs found matching ". $term . "</span>";
	}
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