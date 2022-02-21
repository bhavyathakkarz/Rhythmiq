<?php 
class Album{
	private $conn;
	private $id;
	private $title;
	private $artistid;
	private $genre;
	private $artworkpath;

	public function __construct($conn,$id){
		$this->conn=$conn;
		$this->id=$id;

		$squery="select * from albums where id='$this->id'";
		$query=mysqli_query($this->conn,$squery);
		$album=mysqli_fetch_array($query);

		$this->title=$album['title'];
		$this->artistid=$album['artist'];
		$this->genre=$album['genre'];
		$this->artworkpath=$album['artworkpath'];
	}

	public function getTitle(){
		return $this->title;
	}

	public function getartist(){
		return new Artist($this->conn,$this->artistid);
	}

	public function getgenre(){
		return $this->genre;
	}

	public function getartworkpath(){
		return $this->artworkpath;
	}

	public function getnoofsongs(){
		$squery="select * from songs where album='$this->id'";
		$query=mysqli_query($this->conn,$squery);
		return mysqli_num_rows($query);
	}

	public function getsongid(){
		$squery="select id from songs where album='$this->id' order by albumorder ASC";
		$query=mysqli_query($this->conn,$squery);
		$array=array();
		while($row=mysqli_fetch_array($query)){
			array_push($array,$row['id']);
		}
		return $array;
	}

}

?>