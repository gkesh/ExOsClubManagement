<?php
	require("setsession.php");
	session_start();
	$usrnm = $_POST['username'];
	$password = $_POST['password'];
	$welcome_page="../home.php";
	
	
	
	//creating a new db connection
	$con = mysqli_connect('localhost','root','','ict_club');

	//Checking Connection
	if (!$con) {
		die('Connection Failed: ' . mysqli_error($con));
	}

	mysqli_select_db($con,"ict_club");
	
	$sql="SELECT * FROM users WHERE username = '".$usrnm."' AND password = '".$password."'";
	$result = mysqli_query($con,$sql);
	
	//To Start session
	$_SESSION['lguser']=setUserToSession($result);
	
	mysqli_close($con);
	if($_SESSION['lguser']!=null){
		$welcome_page="../home.php";
		header("Location:$welcome_page", TRUE);
	}else{
		$welcome_page=$_SERVER['HTTP_REFERER'];
		header("Location:$welcome_page", FALSE);
	}
?>