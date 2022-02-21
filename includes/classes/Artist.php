<?php
class artist{
	private $conn;
	private $id;
	public function __construct($conn,$id){
		$this->conn=$conn;
		$this->id=$id;
	}
	public function getid(){
		return $this->id;
	}
	public function getname(){
		$squery="select name from artist where id='$this->id'";
		$query=mysqli_query($this->conn,$squery);
		$result=mysqli_fetch_array($query);
		return $result['name'];
	}
	public function getsongid(){
		$squery="select id from songs where artist='$this->id' order by plays ASC";
		$query=mysqli_query($this->conn,$squery);
		$array=array();
		while($row=mysqli_fetch_array($query)){
			array_push($array,$row['id']);
		}
		return $array;
	}

}
?>