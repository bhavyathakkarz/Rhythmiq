<?php 
include 'includes/includedFile.php'; 
?>
<h1 class="pageheading">You Might Also Like</h1>
<div id="gridview">
	<?php 
	$s="select * from albums order by rand() limit 10";
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