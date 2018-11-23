<?php
	require_once("attendeedata.php");
	$eventname=$_GET["enm"];
	session_start();
	//create a connection
	$con = mysqli_connect('localhost','root','','ict_club');

	//Checking Connection
	if (!$con) {
		die('Connection Failed: ' . mysqli_error($con));
	}

	mysqli_select_db($con,"ict_club");
	
	$sql="Select * from events where event_name LIKE '".$eventname."%'";
	
	$result = mysqli_query($con,$sql);
	
	//get data from db and set it to session
	while($eventdata = mysqli_fetch_array($result)){
		//ereg("[a-Z](.*)?(\s)?:",$eventdata["event_name"],$match);
		$_SESSION["s_event_id"]=$eventdata["event_id"];
		$match=explode(":",$eventdata["event_name"]);
		$_SESSION["s_event_name"]=$match[0];//substr_replace($match[0], "", -1);
		$_SESSION["s_event_location"]=$eventdata["event_location"];
		$_SESSION["s_event_speakers"]=$eventdata["event_speakers"];
		$_SESSION["s_event_date"]=$eventdata["event_date"];
	}
	
	$sql="Select * from attendees where events LIKE '%".$_SESSION["s_event_id"].",%'";
	
	$atlist = array();
	$index=0;
	
	$result = mysqli_query($con,$sql);
	
	while($adata = mysqli_fetch_array($result)){
		$at = new attendeedata();	
		$at->setEmail($adata['email']);
		$at->setName($adata['full_name']);
		$at->setFaculty($adata['faculty']);
		$at->setLevel($adata['level']);
		$at->setCollege($adata['college']);
		$atlist[$index] = $at;
		$index++;
	}
	if($index!=0){
		$_SESSION['attendeeData']=$atlist;
	}
	
	mysqli_close($con);
	
	//Redirect to display page
	if(isset($_SESSION["s_event_name"])){
		$welcome_page="../eventdisplay.php";
		header("Location:$welcome_page", TRUE);
	}else{
		$welcome_page=$_SERVER['HTTP_REFERER'];
		header("Location:$welcome_page", FALSE);
	}
?>