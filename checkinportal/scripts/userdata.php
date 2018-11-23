<?php
	class userdata{
		//private variables for data storage and added security
		private $id;
		private $fname;
		private $lname;
		private $username;
		private $country;
		private $dob;
		private $sex;
		private $phone_no;
		private $added_date;
		private $email;
		private $address;
		private $profile_img;
		
		//Constructor
		function __construct(){
			//Default Constructor
		}
		
		//Getters & setters
                function getId() {
                    return $this->id;
                }

                function getFname() {
                    return $this->fname;
                }

                function getLname() {
                    return $this->lname;
                }

                function getUsername() {
                    return $this->username;
                }

                function getCountry() {
                    return $this->country;
                }

                function getDob() {
                    return $this->dob;
                }

                function getSex() {
                    return $this->sex;
                }

                function getPhone_no() {
                    return $this->phone_no;
                }

                function getAdded_date() {
                    return $this->added_date;
                }

                function getEmail() {
                    return $this->email;
                }

                function getAddress() {
                    return $this->address;
                }

                function getProfile_img() {
                    return $this->profile_img;
                }

                function setId($id) {
                    $this->id = $id;
                }

                function setFname($fname) {
                    $this->fname = $fname;
                }

                function setLname($lname) {
                    $this->lname = $lname;
                }

                function setUsername($username) {
                    $this->username = $username;
                }

                function setCountry($country) {
                    $this->country = $country;
                }

                function setDob($dob) {
                    $this->dob = $dob;
                }

                function setSex($sex) {
                    $this->sex = $sex;
                }

                function setPhone_no($phone_no) {
                    $this->phone_no = $phone_no;
                }

                function setAdded_date($added_date) {
                    $this->added_date = $added_date;
                }

                function setEmail($email) {
                    $this->email = $email;
                }

                function setAddress($address) {
                    $this->address = $address;
                }

                function setProfile_img($profile_img) {
                    $this->profile_img = $profile_img;
                }

                
	}
?>