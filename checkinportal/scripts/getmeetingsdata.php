<?php
  require_once("meetingdata.php");
  $meetingname = $_GET['mnm'];

  //create a connection
	$con = mysqli_connect('localhost','root','','ict_club');

	//Checking Connection
	if (!$con) {
		die('Connection Failed: ' . mysqli_error($con));
	}

	mysqli_select_db($con,"ict_club");

	$sql="Select * from meetings where meeting_title LIKE '".$meetingname."%'";

	$result = mysqli_query($con,$sql);

  $meeting = new meetingdata();
  while($row = mysqli_fetch_array($result)){
    $meeting->setTitle($row['meeting_title']);
    $meeting->setDetails($row['meeting_details']);
    $meeting->setLocation($row['meeting_location']);
    $meeting->setMeetingDate($row['meeting_date']);
    $meeting->setStartTime($row['start_time']);
    $meeting->setEndTime($row['end_time']);
  }
  mysqli_close($con);
  session_start();
  $_SESSION['srch_meeting'] = $meeting;
  if(isset($_SESSION['srch_meeting'])){
		$welcome_page="../meetingdisplay.php";
		header("Location:$welcome_page", TRUE);
	}
 ?>
