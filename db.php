<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * DataBase Class
 */
class DB{
	
	public $db;
	function __construct(){
		$host = 'localhost';
		$database = 'raketadb';
		$user = 'admin';
		$pswd = '123456';
		 
		$db = mysqli_connect($host, $user, $pswd, $database);
		$this->db = $db;

		if(!$db){
			exit("Connect Error.");
		}
	}

	function __destruct(){
		$this->db->close();
	}	

	function CreateProfile($fio, $emails, $phones){
		$this->db->query("INSERT INTO profile (fio) VALUES ('".$fio."');");
		$profile_id = $this->db->insert_id;

		foreach ($emails as $email) {
			$this->db->query("INSERT INTO emails (email, profile_id) VALUES ('".$email."', '".$profile_id."');");
		}

		foreach ($phones as $phone) {
			$this->db->query("INSERT INTO telephones (phone, type, profile_id) VALUES ('".$phone[0]."', '".$phone[1]."', '".$profile_id."');");
		}
	}

	function GetProfile($id){
		$profile = $this->db->query("SELECT fio FROM profile WHERE id = ".$id)->fetch_assoc();

		$em = array();
		$emails = $this->db->query("SELECT email FROM emails WHERE profile_id = ".$id);
		while( $row = $emails->fetch_assoc() ){
			$em[] = $row['email'];
		}

		$ph = array();
		$phones = $this->db->query("SELECT phone, type FROM telephones WHERE profile_id = ".$id);
		while( $row = $phones->fetch_assoc() ){
			$ph[] = array($row['phone'], $row['type']);
		}
	
		return array($profile['fio'], $em, $ph);
	}

	function GetAllProfiles(){
		$ids = $this->db->query("SELECT id FROM profile ORDER BY id DESC");
		while( $row = $ids->fetch_assoc() ){
			$profiles_ids[] = $row['id'];
		}
		return $profiles_ids;
	}

	function DeleteProfile($id){
		$this->db->query("DELETE FROM profile WHERE id = ".$id);
		$this->db->query("DELETE FROM emails WHERE profile_id = ".$id);
		$this->db->query("DELETE FROM telephones WHERE profile_id = ".$id);
	}
	// Да, метод спорный. Но он куда лучше других вариантов
	function UpdateProfile($id, $fio, $emails, $phones){
		$this->DeleteProfile($id);
		$this->CreateProfile($fio, $emails, $phones);
	}

}
