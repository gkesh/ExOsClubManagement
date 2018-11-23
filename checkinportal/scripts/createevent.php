<?php
	//Form Data
	$date = new DateTime();
	$curdate = $date->format('Y-m-d');
	$eventname=strtolower($_POST['eventname']).":".$curdate;
	$location=$_POST['location'];
	$speakers=$_POST['speakers'];
	
	//Database Connection
	$servername="localhost";
	$username="root";
	$password="";
	$dbname="ict_club";

		
	//Connection Created
	$con = new mysqli($servername,$username,$password,$dbname);
	
	
	//Test Connection
	if($con->connect_error){
		die("Connection Failed :".$con->connect_error);
	}
	
	//prepare 
	$stmt = $con->prepare("INSERT INTO events (event_name, event_location, event_speakers) VALUES (?,?,?)");
	
	//bind
	$stmt->bind_param("sss",$eventname,$location,$speakers);
	
	//execute prepared statement
	$stmt->execute();
	
	//get event id
	$sql="SELECT event_id from events where event_name='".$eventname."'";
	$result = $con->query($sql);
	$row = $result->fetch_assoc();
	
	//Redirect to checkin
	session_start();
	$_SESSION['eventname']=$eventname;
	$_SESSION['event_id']=$row['event_id'];
	$goto="../checkin.php";
	header("Location:$goto", TRUE);
	
	
	//close connection and preparedStatment
	$stmt->close();
	$con->close();
	exit();
?>