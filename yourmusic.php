<?php 
include 'includes/includedFile.php';
?>
<div class="playlistcontainer">
	<div class="gridviewcontainer">
		<h1 style="text-align:center;">PLAYLISTS</h1>
		<div class="buttongroup">
			<button class="playlistbtn" style="margin:0 auto;" onclick="createPlaylist();">NEW PLAYLIST</button>
		</div>
		<?php 
			$username=$userloggedin->getUsername();
			$s="select * from playlists where owner='$username'";
			$query=mysqli_query($conn,$s);
			if(mysqli_num_rows($query)==0){
				echo "<span class='noresult'>You don't have any playlist yet.</span>";
			}
			while($row=mysqli_fetch_array($query)){
				// echo $row['title'] . "<br/>";
				$playlist=new Playlist($conn,$row);

				echo "<div class='gridviewitem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=".$playlist->getId()."\")'>
						<div class='playlistimg'>
							<img src='assets/images/icons/playlist.png'>
						</div>
						<div class='gridviewinfo' style='color:white;'>
							".$playlist->getName()."
						</div>
					  </div>";
			}
		?>
	</div>
</div>