<?php
	session_start();
	$reqstr =$_POST["reqstr"];

	if(!strpos($reqstr," ")){
		if ($reqstr=="all") {
			$sql="SELECT first_name,last_name,username,profile_image FROM users";
		}else{
			$sql="SELECT first_name,last_name,username,profile_image FROM users WHERE first_name LIKE '".$reqstr."%'";
		}
	}else{
		$naam = explode(" ",$reqstr);
		$sql="SELECT first_name,last_name,username,profile_image FROM users WHERE first_name LIKE '".$naam[0]."%' AND last_name LIKE '".$naam[1]."%'";
	}

	//creating a new db connection
	$con = mysqli_connect('localhost','root','','ict_club');

	//Checking Connection
	if (!$con) {
		die('Connection Failed: ' . mysqli_error($con));
	}

	mysqli_select_db($con,"ict_club");


	$result = mysqli_query($con,$sql);

	$users = array();

	while($row = mysqli_fetch_array($result)){
		if($row['profile_image']==null){
			$users[sizeof($users)]=$row['first_name']." ".$row['last_name']."&".$row['username']."&"."#";
		}else{
			$users[sizeof($users)]=$row['first_name']." ".$row['last_name']."&".$row['username']."&".$row['profile_image'];
		}
	}

	foreach($users as $values){
		echo $values."\n";
	}

	mysqli_close($con);
?>
