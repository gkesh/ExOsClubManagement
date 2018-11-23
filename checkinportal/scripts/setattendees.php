<?php
	session_start();
	$fname=$_POST['fullname'];
	$email=$_POST['email'];
	$faculty=$_POST['faculty'];
	$level=$_POST['level'];
	$college=$_POST['college'];
	$eventid=$_SESSION['event_id'].",";
	
	//Database Connection	
	$con = new mysqli("localhost","root","","ict_club");
	
	
	//Test Connection
	if($con->connect_error){
		die("Connection Failed :".$con->connect_error);
	}
	
	//append to pervious events 
	$sql="SELECT events from attendees where email='".$email."'";
	$result = $con->query($sql);
	
	if($result->num_rows == 0){
		//For master table
		//prepare 
		$stmt = $con->prepare("INSERT INTO attendees (full_name, email, faculty, level, college, events) VALUES (?,?,?,?,?,?)");
	
		//bind
		$stmt->bind_param("ssssss",$fname,$email,$faculty,$level,$college,$eventid);
	
		//execute prepared statement
		$stmt->execute();
	
		//close connection and preparedStatment
		$stmt->close();
	}else{
		//If attendee has already attended
		$row = $result->fetch_assoc();
		$events=$row['events'].$eventid;
		$stmt = $con->prepare("UPDATE attendees set events = ? where email='".$email."'");
		$stmt->bind_param("s",$events);
		$stmt->execute();
	}
	
	//close connection and refresh the page
	$con->close();
	$_SESSION['attendeename']=$fname;
	$goto=$_SERVER['HTTP_REFERER'];
	header("Location:$goto",TRUE);
	exit();
?>