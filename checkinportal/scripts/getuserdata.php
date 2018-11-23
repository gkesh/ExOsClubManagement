<?php
	session_start();
	require("setsession.php");
	$username=$_GET['unm'];
	
	//creating a new db connection
	$con = mysqli_connect('localhost','root','','ict_club');

	//Checking Connection
	if (!$con) {
		die('Connection Failed: ' . mysqli_error($con));
	}

	mysqli_select_db($con,"ict_club");
	
	$sql="SELECT * FROM users WHERE username = '".$username."'";
	$result = mysqli_query($con,$sql);
	
	//To Start session
	$_SESSION['srch_user']=setUserToSession($result);
	
	mysqli_close($con);
	
	if(isset($_SESSION['srch_user'])){
		$welcome_page="../showsrchuser.php";
		header("Location:$welcome_page", TRUE);
	}
?>