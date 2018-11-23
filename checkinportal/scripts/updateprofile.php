<?php
	require("setsession.php");
	session_start();
	$name=explode(" ",$_POST['fname']);
	$fname=$name[0];
	$lname=$name[1];
	$id = $_SESSION['lguser']->getId();
	$email=$_POST['email'];
	$usrnm=$_POST['uname'];
	$phn=$_POST['phn'];
	$address=$_POST['addr'];
	$bg=$_SESSION['bgimg'];
	
	if($_FILES['profileimage']['name']!=""){
	//For image upload
	$imgLoc = "../images/profilepics/";
	
	$path = $_FILES['profileimage']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	
	$imgFile = $imgLoc .$_SESSION['lguser']->getUsername().".".$ext;
	$imgupCondn = 1;
	
	// Check Image Validity
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["profileimage"]["tmp_name"]);
		if($check !== false) {
			$imgupCondn = 1;
		} else {
			echo "File is not an image.";
			$imgupCondn = 0;
		}
	}
	
	// Check if file already exists
	if (file_exists($imgLoc.$_SESSION['lguser']->getUsername().".".$_SESSION['lguser']->getProfile_img())) {
		unlink($imgLoc.$_SESSION['lguser']->getUsername().".".$_SESSION['lguser']->getProfile_img());
	}
	// Check file size
	if ($_FILES["profileimage"]["size"] > 5000000) {
		echo "Upload Size exceeded";
		$imgupCondn = 0;
	}
	
	// Check for any errors that might have occured
	if ($imgupCondn == 0) {
		echo "Sorry, your image was not uploaded.";
	} else {
		if (move_uploaded_file($_FILES["profileimage"]["tmp_name"], $imgFile)) {
			echo "Uploaded Succesfully!";
		} else {
			echo "Sorry, there was an error uploading your image.";
		}
	}
	}else{
		$ext=$_SESSION['lguser']->getProfile_img();
		//If username is changed the name of the image must also be changed 
		if($usrnm!=$_SESSION['lguser']->getUsername()){
			$old = "../images/profilepics/".$_SESSION['lguser']->getUsername().".".$ext;
			$new = "../images/profilepics/".$usrnm.".".$ext;
			rename($old, $new);
		}
	}
	//Go to Database and update the data there
	//Gonna use prepared statements for this
	
	//Database Connection	
	$con = new mysqli("localhost","root","","ict_club");
	
	
	//Test Connection
	if($con->connect_error){
		die("Connection Failed :".$con->connect_error);
	}

	//append to pervious events 
	if($_POST['psw']==""){
		$sql="UPDATE users set first_name = ?, last_name = ?, address = ?, email = ?, username = ?, phone_no = ?, profile_image = ? where id = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("sssssssi",$fname,$lname,$address,$email,$usrnm,$phn,$ext,$id);
	}else{
		$sql="UPDATE users set first_name = ?, last_name = ?, address = ?, email = ?, username = ?, password = ?, phone_no = ?, profile_image = ? where id = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("ssssssssi",$fname,$lname,$address,$email,$usrnm,$_POST['psw'],$phn,$ext,$id);
	}
	$stmt->execute();
	
	
	$redirec="\"location.href='scripts/getuserdata.php?unm=$usrnm'\"";
	$rec_id="($id)";
	try{
	//To set notification
		if("male"==strtolower($_SESSION['lguser']->getSex())){
			$notftitle="UPDATE : ".$fname." just updated his profile";
			$notf_detail=$fname." has made a few changes to his profile. Click <a onclick=$redirec>here</a> to visit his profile...";
		}else{
			$notftitle="UPDATE : ".$fname." just updated her profile";
			$notf_detail=$fname." has made a few changes to her profile. Click <a onclick=$redirec>here</a> to visit her profile...";
		}
		//query for insertion in notification table
		$sql="INSERT INTO `notifications`(`notf_title`, `notf_detail`,`notf_recievers`) VALUES (?,?,?)";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("sss",$notftitle,$notf_detail,$rec_id);
		$stmt->execute();
		
		$sql="UPDATE notifications set notf_title = ?, notf_detail = ?  where notf_title LIKE '%".$fname."%'";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("ss",$notftitle,$notf_detail);
		$stmt->execute();
		
	}catch(Exception $e){
		die("Error:: ".$e->getMessage());
	}
	
	//To reset the page
	session_destroy();
	session_start();
	
	$sql="SELECT * FROM users WHERE id ='".$id."'";
	$result = mysqli_query($con,$sql);
	
	//Resetting session data
	$_SESSION['lguser']=setUserToSession($result);
	$_SESSION['bgimg']=$bg;
	
	
	
	//close connection and redirect to profile
	$con->close();
	$welcome_page="../profile.php";
	header("Location:$welcome_page", TRUE);
?>