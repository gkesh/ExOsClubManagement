<?php
	session_start();
	
	try{
		$con = new mysqli("localhost","root","","ict_club");
		
		$sql = "Select * from events WHERE event_id='".$_SESSION['event_id']."'";
		
		$row = mysqli_fetch_array(mysqli_query($con,$sql));
		$event_name=explode(":",$row['event_name']);
		$event_loc=$row['event_location'];
		$redirec="location.href='scripts/geteventsdata.php?enm=$event_name[0]'";
		$notftitle="EVENT CONDUCTED : ".$event_name[0];
		$notf_detail="An event with the title $event_name[0] was conducted today at $event_loc. Click <a onclick=\"$redirec\">here</a> to view the details...";
		
		$sql="INSERT INTO `notifications`(`notf_title`, `notf_detail`) VALUES (?,?)";
		$stmt = $con->prepare($sql);
		$stmt->bind_param("ss",$notftitle,$notf_detail);
		$stmt->execute();
	}catch(Exception $e){
		echo("ERROR:: ".$e->getMessage());
	}finally{
		$con->close();
	}
	unset($_SESSION['event_name']);
	unset($_SESSION['event_id']);
	
	header("Location:../events.php");
	
?>