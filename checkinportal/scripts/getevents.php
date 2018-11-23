<?php
	session_start();
	//creating a new db connection
	$con = mysqli_connect('localhost','root','','ict_club');

	//Checking Connection
	if (!$con) {
		die('Connection Failed: ' . mysqli_error($con));
	}

	mysqli_select_db($con,"ict_club");
	
	$sql="SELECT * FROM events";
	$result = mysqli_query($con,$sql);
	
	$events = array();
	
	while($row = mysqli_fetch_array($result)){
		$events[sizeof($events)]=$row['event_name'];
	}
	$_SESSION["event_list"]=$events;
	
	if(isset($_SESSION["event_list"])){
	//Redirect to events
	$welcome_page="../events.php";
	header("Location:$welcome_page", TRUE);
	}
	
	mysqli_close($con);
?>