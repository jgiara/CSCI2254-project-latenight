
<?php 
class Users{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	 
	
	public function email_exists($Email) {

		$query = $this->db->prepare("SELECT COUNT(`Eagle_Id`) FROM `Users` WHERE `Email`= ?");
		$query->bindValue(1, $Email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

public function register( $Password, $Email, $First_Name, $Last_Name, $Eagle_Id, $Address, $Phone, $Type){
		
		$Time 		= time();
		$Ip 		= $_SERVER['REMOTE_ADDR'];
		$Password   = sha1($Password);
		
	 
		$query 	= $this->db->prepare("INSERT INTO `Users` (`Password`, `Email`, `First_Name`, `Last_Name`, `Eagle_Id`, `Address`, `Phone`, `Type`, `Ip`, `Time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
	 
		$query->bindValue(1, $Password);
		$query->bindValue(2, $Email);
		$query->bindValue(3, $First_Name);
        $query->bindValue(4, $Last_Name);
        $query->bindValue(5, $Eagle_Id);
        $query->bindValue(6, $Address);
        $query->bindValue(7, $Phone);
        $query->bindValue(8, $Type);
        $query->bindValue(9, $Ip);
        $query->bindValue(10, $Time);
      
	 
		try{
			$query->execute();
			

		
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	

	public function login($Email, $Password) {

		$query = $this->db->prepare("SELECT `Password`, `Eagle_Id`, `Type` FROM `Users` WHERE `Email` = ?");
		$query->bindValue(1, $Email);
		
		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['Password'];
			$Id   				= $data['Eagle_Id'];
			$Type   			= $data['Type'];

			
			if($stored_password === sha1($Password)){
				return $Id;
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	} 

	public function get_type($Email) {

		$query = $this->db->prepare("SELECT `Type` FROM `Users` WHERE `Email` = ?");
		$query->bindValue(1, $Email);
		
		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$Type   			= $data['Type'];
			
			return $Type;
			

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	} 

	public function userdata($Eagle_Id) {

		$query = $this->db->prepare("SELECT * FROM `Users` WHERE `Eagle_Id`= ?");
		$query->bindValue(1, $Eagle_Id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}

	  	  	 
	public function get_users() {

		$query = $this->db->prepare("SELECT * FROM `Users`");
		
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetch();

		}	

	public function menu_items() {

		$query = $this->db->prepare("SELECT * FROM Items");

		try{

			$query->execute();

			return $query->fetchAll();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}
	
		

public function recover($Email) {

	$letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$newpass = substr(str_shuffle($letters), 0, 8);
	$encryptpass =  sha1($newpass);

	$message = "Hello User,\r\nYour new password is ".$newpass.".";
	$headers = "From: sendler@bc.edu" . "\r\n" .
			"Cc: christian.sendler@gmail.com.com";

	$query = $this->db->prepare("UPDATE Users SET Password='$encryptpass' WHERE `Email`= ?");
	$query->bindValue(1, $Email);

		try{
			$query->execute();

			mail($email,"Munchies@BC: Password Reset",$message, $headers);

		
		}catch(PDOException $e){
			die($e->getMessage());
		}	

}



} //close class















