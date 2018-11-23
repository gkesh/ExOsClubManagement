<?php
		$con = new mysqli("localhost","root","","ict_club");
	//to put id into notification for exclusion
		$sql = "SELECT id FROM users WHERE username ='gkesh' limit 1";
		$result = mysqli_query($con,$sql);
		$req_id = "(".mysqli_fetch_object($result)->id.")";
		echo($req_id);
?>