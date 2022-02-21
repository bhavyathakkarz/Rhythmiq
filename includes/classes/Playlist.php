<?php 
class Playlist{
	private $conn;
	private $id;
	private $name;
	private $owner;

	public function __construct($conn,$data){

		if(!is_array($data)){
			$dquery=mysqli_query($conn,"select * from playlists where id='$data'");
			$data=mysqli_fetch_array($dquery);
		}
		$this->conn=$conn;
		$this->id=$data['id'];
		$this->name=$data['name'];
		$this->owner=$data['owner'];
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function getOwner(){
		return $this->owner;
	}

	public function getnoofsongs(){
		$squery="select songsId from playlistsongs where playlistId='$this->id'";
		$query=mysqli_query($this->conn,$squery);
		return mysqli_num_rows($query);
	}

	public function getsongid(){
		$squery="select songsId from playlistsongs where playlistId='$this->id' order by playlistOrder ASC";
		$query=mysqli_query($this->conn,$squery);
		$array=array();
		while($row=mysqli_fetch_array($query)){
			array_push($array,$row['songsId']);
		}
		return $array;
	}

	public static function getPlaylistsDropDown($conn,$username){
		$dropdown='<select class= "item playlist">
					<option value="">Add to Playlist</option>';

		$dquery=mysqli_query($conn,"select id,name from playlists where owner='$username'");
		while($row=mysqli_fetch_array($dquery)){
			$id=$row['id'];
			$name=$row['name'];

			$dropdown=$dropdown."<option value=".$id.">".$name."</option>";
		}

		return $dropdown . '</select>';
	}
}
?>