var currentplaylist=[];
var shuffleplaylist=[];
var tempPlaylist=[];
var audioelement;
var mouseDown=false;
var currentIndex=0;
var repeat=false;
var shuffle=false;
var userLoggedIn;
var timer;

$(document).click(function(e){
	var target=$(e.target);
	if(!target.hasClass('item') && !target.hasClass('optionbtn')){
		hideOptionMenu();
	}

});

$(window).scroll(function(){
	hideOptionMenu();
});

$(document).on("change","select.playlist",function(){
	var select=$(this);
	var playlistId=select.val();   
	var songid=select.prev(".songId").val();
	$.post("includes/handlers/ajax/addToPlaylist.php",{playlistId:playlistId,songId:songid}).done(function(error){
		if(error!=""){
			alert(error);
			return;
		}
		hideOptionMenu();
		select.val("");
	});
});

function openPage(url){
	if(timer!=null){
		clearTimeout(timer);
	}
	if(url.indexOf("?")==-1){
		url=url + "?";
	}
	var encodedurl=encodeURI(url + "&userloggedin=" + userLoggedIn);
	console.log(encodedurl);
	$("#maincontent").load(encodedurl);
	$("body").scrollTop(0);
	history.pushState(null,null,url);
}

function createPlaylist(){
	var popup= prompt("Please enter the name of your playlist");
	if(popup!=null){
		$.post("includes/handlers/ajax/createPlaylist.php",{playlistname:popup,username:userLoggedIn})
		.done(function(error){
			if(error!=""){
				alert(error);
				return;
			}
			openPage("yourmusic.php");
		});
	}
	
}
function deletePlaylist(playlistId){
	var popup=confirm("Are you sure you want to delete this playlist?");
	if(popup){
		$.post("includes/handlers/ajax/deletePlaylist.php",{playlistId:playlistId})
		.done(function(error){
			if(error!=""){
				alert(error);
				return;
			}
			openPage("yourmusic.php");
		});
	}
}

function removeFromPlaylist(button,playlistId){
	var songId=$(button).prevAll(".songId").val();
	$.post("includes/handlers/ajax/removeFromPlaylist.php",{playlistId:playlistId,songId:songId})
		.done(function(error){
			if(error!=""){
				alert(error);
				return;
			}
			hideOptionMenu();
			openPage("playlist.php?id="+playlistId);
		});
}

function updateUsername(usernameClass){
	var username=$("."+usernameClass).val();
	$.post("includes/handlers/ajax/updateUsername.php",{old_username:userLoggedIn,new_username:username})
	.done(function(spanMsg){
		$("."+usernameClass).nextAll(".message").text(spanMsg);
	});
}

function updatePassword(oldPassClass,newPassClass,cPassClass){
	var oldPass=$("."+oldPassClass).val();
	var newPass=$("."+newPassClass).val();
	var cPass=$("."+cPassClass).val();
	$.post("includes/handlers/ajax/updatePassword.php",{oldPassword:oldPass,
		newPassword:newPass,
		cPassword:cPass,
		username:userLoggedIn})
	.done(function(spanMsg){
		$("."+oldPassClass).nextAll(".message").text(spanMsg);
	});
}

function logout(){
	$.post("includes/handlers/ajax/logout.php",function(){
		location.replace("register.php");
	});
}

function showOptionMenu(button){
	var songid=$(button).prevAll(".songId").val();
	var menu=$(".optionsMenu");
	var wid=menu.width();
	menu.find(".songId").val(songid);
	var scrollTop=$(window).scrollTop();
	var elementoffset=$(button).offset().top;

	var ttop=elementoffset-scrollTop;
	var lleft=$(button).position().left-wid;

	menu.css({
		"top":ttop+"px",
		"left": lleft+"px",
		"display":"inline"

	});
}

function hideOptionMenu(){
	var menu=$(".optionsMenu");
	if(menu.css("display")!="none"){
		menu.css("display","none");
	}
}
function formatTym(seconds){
	var time=Math.round(seconds);
	var minutes=Math.floor(time/60);
	var seconds=time-(minutes*60);

	var extraZero;
	if(seconds<10){
		extraZero="0";
	}
	else{
		extraZero="";
	}
	return minutes+":"+extraZero+seconds;

}
function updateTimeProgressBar(audio){
	$(".starttime.tym").text(formatTym(audio.currentTime));
	$('.remaintime.tym').text(formatTym(audio.duration-audio.currentTime));

	var progressBar=audio.currentTime/audio.duration * 100;
	$(".playbarcontainer .progress").css("width",progressBar + "%");
}

function updateVolumeProgressBar(audio){
	var volumeBar=audio.volume * 100;
	$(".volumebar .progress").css("width",volumeBar + "%");

}

function playFirst(){
	setTrack(tempPlaylist[0],tempPlaylist,true);
}

function Audio(){
	 this.currentlyplaying;
	 this.audio=document.createElement("audio");
	 this.audio.addEventListener("ended",function(){
	 	nextsong();
	 });
	 this.audio.addEventListener('canplay',function(){
	 	duration=formatTym(this.duration);
	 	$('.remaintime.tym').text(duration);
	 });
	 this.audio.addEventListener('timeupdate',function(){
	 	if(this.duration){
	 		updateTimeProgressBar(this);
	 	}
	 })

	 this.audio.addEventListener('volumechange',function(){
	 	updateVolumeProgressBar(this);
	 });

	 this.setTrack=function(track){
	 	this.currentlyplaying=track;
	 	this.audio.src=track.path;
	 }
	 this.play=function(){
	 	this.audio.play();
	 }
	 this.pause=function() {
	 	this.audio.pause();
	 }
	 this.setTime=function(seconds){
	 	this.audio.currentTime=seconds;
	 	console.log(this.audio.currentTime);
	 }
}
