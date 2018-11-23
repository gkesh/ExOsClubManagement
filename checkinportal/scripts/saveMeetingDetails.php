<?php
  $meetingTitle = $_POST['title'];
  $meetingLocation = $_POST['location'];
  $meetingStartTime = $_POST['start_time'];
  $meetingEndTime = $_POST['end_time'];
  $meetingDetails = $_POST['agendas'].$_POST['summary'];
  $meetingDate = $_POST['date'];
  $meetingUsers = $_POST['usernames'];
  $meetingAttendees = $_POST['attendees'];
  $fileloc = "files/meeting_data_files/".trim($meetingTitle)."(".date("d-m-Y").").txt";
  $my_file = "../files/meeting_data_files/".trim($meetingTitle)."(".date("d-m-Y").").txt";
  $fileData = $meetingTitle.$meetingDate."Start Time: ".$meetingStartTime."Location :".$meetingLocation.$meetingDetails.$meetingAttendees."End Time :".$meetingEndTime;
  $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
  fwrite($handle,$fileData);
  fclose($handle);
  try{
		//$con = DB::connect($dsn);
		//Database Connection
		$con = new mysqli("localhost","root","","ict_club");
		//Inserting data
		//prepare
		$stmt = $con->prepare("INSERT INTO meetings (meeting_title, meeting_details, meeting_attendees, meeting_date, meeting_location, start_time, end_time) VALUES (?,?,?,?,?,?,?)");

		//bind
		$stmt->bind_param("sssssss",$meetingTitle,$fileloc,trim($meetingUsers), trim($meetingDate), trim($meetingLocation), trim($meetingStartTime), trim($meetingEndTime));

		//execute prepared statement
		$stmt->execute();

	}catch(Exception $e){
		die("Error::".$e->getMessage());
	}finally{
		$stmt->close();
    $con->close();
	}
		$welcome_page="../startmeeting.php";
		header("Location:$welcome_page", TRUE);
?>
