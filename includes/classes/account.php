<?php
class account{
	private $conn;
	private $errorarray;
	public function __construct($conn){
		$this->conn=$conn;
		$this->errorarray=array();
	}
	public function register($un,$fn,$ln,$p,$cp,$e){
		$this->validateusername($un);
		$this->validatefname($fn);
		$this->validatelname($ln);
		$this->validatepassword($p,$cp);
		$this->validateemail($e);

		if(empty($this->errorarray)){
			return $this->insertsdetail($un,$fn,$ln,$p,$e);
		}
		else{
			return false;
		}
	}
	public function login($un,$p){
		$select="select * from users where username='$un'";
		$result=mysqli_query($this->conn,$select);
		if(mysqli_num_rows($result)==1){
			$arr=mysqli_fetch_array($result);
			$pass=$arr['password'];
			$pverify=password_verify($p,$pass);
			if($pverify){
				return true;
			}
			else{
				array_push($this->errorarray,constants::$loginfail);
				return false;
			}

		}
		else{
			array_push($this->errorarray,constants::$unfail);
			return false;
		}

	}
	public function geterror($error){
		if(!in_array($error,$this->errorarray)){
			$error="";
		}
		return "<span id='error' class='error'>$error</span>";
	}
	private function insertsdetail($un,$fn,$ln,$p,$e){
		$pass=password_hash($p, PASSWORD_BCRYPT);
		$pic="assets/images/profile-pic/profile.jpeg";
		$date=date("Y-m-d");
		$insert="Insert into users (username,fname,lname,email,password,signupdate,profilepic) values ('$un','$fn','$ln','$e','$pass','$date','$pic')";
		$result=mysqli_query($this->conn,$insert);
		return $result;

	}
	private function validateusername($un){
		if(strlen($un)<=2 || strlen($un)>20){
			array_push($this->errorarray,constants::$uname);
			return;
		}
		$select="Select * from users where username='$un'";
		$result=mysqli_query($this->conn,$select);
		if(mysqli_num_rows($result)>0){
			array_push($this->errorarray,constants::$untaken);
			return;
		}
	}
	private function validatefname($fn){
		if(strlen($fn)<=2 || strlen($fn)>20){
			array_push($this->errorarray,constants::$fname);
			return;
		}
		
	}
	private function validatelname($ln){
		if(strlen($ln)<=2 || strlen($ln)>20){
			array_push($this->errorarray,constants::$lname);
			return;
		}
		
	}
	private function validatepassword($p,$cp){
		if($p!=$cp){
			array_push($this->errorarray,constants::$pass1);
			return;
		}
		if(strlen($p)<6 || strlen($p)>25){
			array_push($this->errorarray,constants::$pass2);
			return;
		}
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $p)){
			array_push($this->errorarray,constants::$pass3);
			return;
		}
	}
	private function validateemail($e){
		if(!filter_var($e,FILTER_VALIDATE_EMAIL)){
			array_push($this->errorarray,constants::$email);
			return;
		}
		$select="Select * from users where email='$e'";
		$result=mysqli_query($this->conn,$select);
		if(mysqli_num_rows($result)>0){
			array_push($this->errorarray,constants::$emtaken);
			return;
		}
	}
}
?>