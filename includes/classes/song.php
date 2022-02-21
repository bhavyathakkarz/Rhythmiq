<?php 
class song{
	private $conn;
	private $id;
	private $data;
	private $title;
	private $artistid;
	private $albumid;
	private $genre;
	private $duration;
	private $path;

	public function __construct($conn,$id){
		$this->conn=$conn;
		$this->id=$id;

		$squery="select * from songs where id='$this->id'";
		$query=mysqli_query($this->conn,$squery);
		$this->data=mysqli_fetch_array($query);
		$this->title=$this->data['title'];
		$this->artistid=$this->data['artist'];
		$this->albumid=$this->data['album'];
		$this->genre=$this->data['genre'];
		$this->duration=$this->data['duration'];
		$this->path=$this->data['path'];
	}
	public function getId(){
		return $this->id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getartist(){
		return new Artist($this->conn,$this->artistid);
	}

	public function getAlbum(){
		return new Album($this->conn,$this->albumid);
	}

	public function getgenre(){
		return $this->genre;
	}

	public function getduration(){
		return $this->duration;
	}

	public function getpath(){
		return $this->path;
	}

	public function getdata(){
		return $this->data;
	}
}
?>