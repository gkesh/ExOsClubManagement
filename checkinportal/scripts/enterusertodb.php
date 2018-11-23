<?php
	//require_once("DB.php");
	require_once("setsession.php");
	
	//Get data from form here
	$name = explode(" ",$_POST['full_name']);
	
	$fname=$name[0];
	$lname=$name[1];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$usrnm=$_POST['username'];	
	$psswrd=$_POST['password'];
	$country=$_POST['country'];
	$dob=$_POST['dob'];
	$gen=$_POST['gender'];
	$phn=$_POST['phone'];
	
	//Creating Connection
	/*$dsn = array(
		"phptype" => "mysql",
		"hostspec" => "localhost",
		"database" => "ict_club",
		"username" => "root",
		"password" => ""
	);*/
	
	try{
		//$con = DB::connect($dsn);
		//Database Connection	
		$con = new mysqli("localhost","root","","ict_club");
		//Inserting data
		//prepare 
		$stmt = $con->prepare("INSERT INTO users (first_name, last_name, address, email, username, password, country, d_o_b, gender, phone_no) VALUES (?,?,?,?,?,?,?,?,?,?)");
	
		//bind
		$stmt->bind_param("ssssssssss",$fname,$lname,$address,$email,$usrnm,$psswrd,$country,$dob,$gen,$phn);
	
		//execute prepared statement
		$stmt->execute();
		
		//Letting the members know that you exist in this hell hole
		
		$redirec="\"location.href='scripts/getuserdata.php?unm=$usrnm'\"";
		$notftitle="UPDATE : ".$fname." just joined as ".$usrnm;
		
		if("male"==strtolower($gen)){
			$notf_detail=$fname." has created an account in this portal. Click <a onclick=$redirec>here</a> to visit his profile...";
		}else{
			$notf_detail=$fname." has created an account in this portal. Click <a onclick=$redirec>here</a> to visit her profile...";
		}
		//query for insertion in notification table
		$sql="INSERT INTO `notifications`(`notf_title`, `notf_detail`) VALUES (?,?)";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("ss",$notftitle,$notf_detail);
		$stmt->execute();
		
		//to put id into notification for exclusion
		$sql = "SELECT id FROM users WHERE username ='$usrnm' limit 1";
		$result = mysqli_query($con,$sql);
		$req_id = "(".mysqli_fetch_object($result)->id.")";
		
		$stmt = $con->prepare("UPDATE notifications set notf_recievers = ? where notf_title = ?");
		$stmt->bind_param("ss",$req_id,$notftitle);
		$stmt->execute();
		
	}catch(Exception $e){
		die("Error::".$e->getMessage());
	}finally{
		$stmt->close();
	}
	
	//getting data from db
	$sql = "Select * from users where username ='".$usrnm."'";
	
	session_start();
	//Setting to session_cache_expire
	$_SESSION['lguser']=setUserToSession($con->query($sql));
	
	//closing connection
	$con->close();
	
	$welcome_page="../home.php";
	header("Location:$welcome_page", TRUE);

?>