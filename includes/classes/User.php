<?php 
class User{
	private $conn;
	private $username;

	public function __construct($conn,$username){
		$this->conn=$conn;
		$this->username=$username;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getName(){
		$query=mysqli_query($this->conn,"select concat(fname,' ',lname) as 'name' from users where username='$this->username'");
		$row=mysqli_fetch_array($query);
		return $row['name'];
	}
}
?>