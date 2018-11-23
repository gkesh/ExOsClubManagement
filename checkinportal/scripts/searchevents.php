<?php
	session_start();
	$reqstr =$_POST["reqstr"];
	//creating a new db connection
	$con = mysqli_connect('localhost','root','','ict_club');

	//Checking Connection
	if (!$con) {
		die('Connection Failed: ' . mysqli_error($con));
	}

	mysqli_select_db($con,"ict_club");
	
	$sql="SELECT event_name FROM events WHERE event_name LIKE '".$reqstr."%'";
	$result = mysqli_query($con,$sql);
	
	$events = array();
	
	while($row = mysqli_fetch_array($result)){
			$events[sizeof($events)]=$row['event_name'];
	}
	
	foreach($events as $values){
		echo $values."\n";
	}
	
	mysqli_close($con);
?>