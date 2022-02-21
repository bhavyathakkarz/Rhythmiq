<?php 
	$squery="select * from songs order by rand() limit 10";
	$query=mysqli_query($conn,$squery);
	$array=array();
	while($row=mysqli_fetch_array($query)){
		array_push($array,$row['id']);
	}
	$jsonarray=json_encode($array);
?>
<script type="text/javascript">
	$(document).ready(function(){
		var newplaylist=<?php echo $jsonarray; ?>;
		console.log(newplaylist);
		audioelement=new Audio();
		setTrack(newplaylist[0],newplaylist,false);
		updateVolumeProgressBar(audioelement.audio);

		$('#playbardiv').on("mousedown touchstart mousemove touchmove",function(e){
			e.preventDefault();
		})

		$(".playbarcontainer .progressbar").mousedown(function(){
			mouseDown=true;
		});

		$(".playbarcontainer .progressbar").mousemove(function(e){
			if(mouseDown){
				timeFromOffset(e,this);
			}
		});

		$(".playbarcontainer .progressbar").mouseup(function(e){
			timeFromOffset(e,this);
		});


		$(".volumebar .progressbar").mousedown(function(){
			mouseDown=true;
		});

		$(".volumebar .progressbar").mousemove(function(e){
			if(mouseDown){
				var percentage=e.offsetX/$(this).width();

				if(percentage>=0 && percentage<=1){
					audioelement.audio.volume=percentage;
				}
			}
		});

		$(".volumebar .progressbar").mouseup(function(e){
			var percentage=e.offsetX/$(this).width();

			if(percentage>=0 && percentage<=1){
				audioelement.audio.volume=percentage;
			}
		});

		$(document).mouseup(function(){
			mouseDown=false;
		});


	});

	function timeFromOffset(mousemove,progress){
		var percentage=mousemove.offsetX/$(progress).width() * 100;
		console.log(mousemove.offsetX);
		console.log($(progress).width());
		var seconds=audioelement.audio.duration * (percentage/100);
		audioelement.setTime(seconds);
	}

	function nextsong(){
		if(repeat==true){
			audioelement.setTime(0);
			playsong();
			return;
		}
		if(currentIndex==currentplaylist.length-1){
			currentIndex=0;
		}
		else{
			currentIndex++;
		}
		var tracktoplay=shuffle ? shuffleplaylist[currentIndex] : currentplaylist[currentIndex];
		setTrack(tracktoplay,currentplaylist,true);
	}

	function repeatSong(){
		repeat=!repeat;
		var repeatimg=repeat ? "repeat-active.png" : "repeat.png";
		$(".controlbutton.repeat img").attr("src","assets/images/icons/"+repeatimg);
	}

	function prevsong(){
		if(audioelement.audio.currentTime>=3 || currentIndex==0){
			audioelement.setTime(0);
		}
		else {
			currentIndex=currentIndex-1;
			setTrack(currentplaylist[currentIndex],currentplaylist,true);
		}
	}

	function setMute(){
		audioelement.audio.muted=!audioelement.audio.muted;
		var muteimg=audioelement.audio.muted ? "volume-mute.png" : "volume.png";
		$(".controlbutton.volume img").attr("src","assets/images/icons/"+muteimg);
	}

	function setshuffle(){
		shuffle=!shuffle;
		var shuffleimg=shuffle ? "shuffle-active.png" : "shuffle.png";
		$(".controlbutton.shuffle img").attr("src","assets/images/icons/"+shuffleimg);


		if(shuffle==true){
			//Randomize Playlist
			shuffleArray(shuffleplaylist);
			currentIndex=currentplaylist.indexOf(audioelement.currentlyplaying.id);
		}
		else{
			// shuffle deactivate,go back to regular playlist
			currentIndex=currentplaylist.indexOf(audioelement.currentlyplaying.id);
		}
	}
	function shuffleArray(a){
		var i,j,x;
		for(i=a.length;i;i--){
			j=Math.floor(Math.random()*i);
			x=a[i-1];
			a[i-1]=a[j];
			a[j]=x;
		}
	}
	function setTrack(trackid,newplaylist,play){
		if(newplaylist != currentplaylist){
			currentplaylist=newplaylist;
			shuffleplaylist=currentplaylist.slice();
			shuffleArray(shuffleplaylist); 
		}
		if(shuffle==true){
			currentIndex=shuffleplaylist.indexOf(trackid);
		}
		else{
			currentIndex=currentplaylist.indexOf(trackid);
		}
		currentIndex=currentplaylist.indexOf(trackid);
		audioelement.setTime(0);
		pausesong();
		$.post("includes/handlers/ajax/getSong.php",{songId:trackid},function(data){
			var track=JSON.parse(data);
			console.log(track);
			$(".track span").text(track.title);
			$.post("includes/handlers/ajax/getArtist.php",{artistId:track.artist},function(artistdata){
				var artist=JSON.parse(artistdata);
				$(".trackartist span").text(artist.name);
				$(".trackartist span").attr("onclick","openPage('artist.php?id="+artist.id+"')");
			});
			$.post("includes/handlers/ajax/getAlbum.php",{albumId:track.album},function(albumdata){
				var album=JSON.parse(albumdata);
				console.log(album.artworkpath);
				$(".albumart img").attr('src',album.artworkpath);
				$(".albumart img").attr("onclick","openPage('album.php?id="+album.id+"')");
				$(".track span").attr("onclick","openPage('album.php?id="+album.id+"')");
			});
			audioelement.setTrack(track);
			if(play){
				playsong();
			}
		});
		// audioelement.setTrack("assets/music/bensound-acousticbreeze.mp3");JSON.parse(json: string)->Convert Json(string) file to object form
		
	}
	function playsong(){
		console.log(audioelement);
		if(audioelement.audio.currentTime==0){
			// console.log('Music Started');
			$.post('includes/handlers/ajax/getPlay.php',{songId:audioelement.currentlyplaying.id});
		}
		else{
			console.log('Music pause');
		}
		$(".controlbutton.play").hide();
		$(".controlbutton.pause").show();
		audioelement.play();
	}
	function pausesong(){
		$(".controlbutton.play").show();
		$(".controlbutton.pause").hide();
		audioelement.pause();
	}

	// console.log();
</script>
<div id="playbardiv">
	<div id="playbar">
		<div id="playleft">
			<div class="content">
				<span class="albumart">
					<img src="https://jooinn.com/images/square-4.jpg" class="albumartwork" role="link" tabindex="0">
				</span>
				<div class="trackinfo">
					<span class="track">
						<span role="link" tabindex="0"></span>
					</span>
					<span class="trackartist">
						<span role="link" tabindex="0"></span>
					</span>
				</div>
			</div>	
		</div>
		<div id="playcenter">
			<div class="content playerControls">
				<div class="buttons">
					<button class="controlbutton shuffle" title="Shuffle button" onclick="setshuffle();"><img src="assets/images/icons/shuffle.png" alt="Shuffle"></button>
					<button class="controlbutton previous" title="Previous button" onclick="prevsong();"><img src="assets/images/icons/previous.png" alt="Previous"></button>
					<button class="controlbutton play" title="Play button" onclick="playsong();"><img src="assets/images/icons/play.png" alt="Play"></button>
					<button class="controlbutton pause" title="Pause button" onclick="pausesong();" style="display:none;"><img src="assets/images/icons/pause.png" alt="Pause"></button>
					<button class="controlbutton next" title="Next button" onclick="nextsong();"><img src="assets/images/icons/next.png" alt="Next"></button>
					<button class="controlbutton repeat" title="Repeat button" onclick="repeatSong();"><img src="assets/images/icons/repeat.png" alt="Repeat"></button>
				</div>
				<div class="playbarcontainer">
					<span class="starttime tym">0.00</span>
					<div class="progressbar">
						<div class="progressbarbg">
							<div class="progress"></div>
						</div>
					</div>
					<span class="remaintime tym">0.00</span>
				</div>	
			</div>
		</div>
		<div id="playright">
			<div class="volumebar">
				<button class="controlbutton volume" title="Volume button" onclick="setMute();">
					<img src="assets/images/icons/volume.png" alt="volume">
				</button>
				<div class="progressbar">
					<div class="progressbarbg">
						<div class="progress"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>