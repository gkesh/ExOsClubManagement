<?php
  session_start();
  $reqstr = $_POST["reqstr"];

  //Connection
  //creating a new db connection
	$con = mysqli_connect('localhost','root','','ict_club');

	//Checking Connection
	if (!$con) {
		die('Connection Failed: ' . mysqli_error($con));
	}

  $sql = "SELECT meeting_title, meeting_date FROM meetings WHERE meeting_title LIKE '".$reqstr."%'";
  $result = mysqli_query($con, $sql);

  $meetings = array();

  while($row = mysqli_fetch_array($result)){
    $dt = $row['meeting_date'];
    $meetings[sizeof($meetings)]=$row['meeting_title'].":".$dt;
  }

  foreach ($meetings as $values) {
    echo $values."\n";
  }

  mysqli_close($con);
?>
