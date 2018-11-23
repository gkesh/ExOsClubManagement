<?php
	require("userdata.php");
	function setUserToSession($result){
		$usr = new userdata();
		while($row = mysqli_fetch_array($result)){
		$usr->setId($row['id']);
		$usr->setFname($row['first_name']);
		$usr->setLname($row['last_name']);
		$usr->setUsername($row['username']);
		$usr->setCountry($row['country']);
		$usr->setDob($row['d_o_b']);
		$usr->setSex($row['gender']);
		$usr->setPhone_no($row['phone_no']);
		$usr->setAdded_date($row['added_date']);
		$usr->setEmail($row['email']);
		$usr->setAddress($row['address']);
		$usr->setProfile_img($row['profile_image']);
		}
		if($usr->getId()==null){
			return null;
		}
		return $usr;
	}
	
	function setEventToSession($result){
		
	}
?>