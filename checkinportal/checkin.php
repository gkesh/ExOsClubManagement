<?php
	require("scripts/userdata.php");
	session_start();
	if(!isset($_SESSION['lguser'])){
		header("Location:index.php");
	}
	if(isset($_SESSION['attendeename'])){
		$name=$_SESSION['attendeename'];
	}else{
		$name="error";
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Check-in Portal</title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<script type="text/javascript" language="javascript">
	setInterval(clock,1000);
		function checkFac(){
			if(document.getElementById('fac').value == "-1"){
				document.getElementById('err').innerHTML="Please Choose Faculty";
			}else if(document.getElementById('fac').value == "BBS"){
				document.getElementById('lvl').innerHTML="<option value='-1'>&nbsp;&nbsp;Level</option><option value='First Year'>First Year</option><option value='Second Year'>Second Year</option><option value='Third Year'>Third Year</option><option value='Fourth Year'>Fourth Year</option>";
			}else{
				document.getElementById('lvl').innerHTML="<option value='-1'>&nbsp;&nbsp;Level</option><option value='First Semester'>First Semester</option><option value='Second Semester'>Second Semester</option><option value='Third Semester'>Third Semester</option><option value='Fourth Semester'>Fourth Semester</option><option value='Fifth Semester'>Fifth Semester</option><option value='Sixth Semester'>Sixth Semester</option><option value='Seventh Semester'>Seventh Semester</option><option value='Eighth Semester'>Eighth Semester</option>";
			}
		}
		function chechLvl(){
			if(document.getElementById('lvl').value == "-1"){
				document.getElementById('err').innerHTML="Please Choose Level";
			}
		}
		function clock(){
			var d = new Date();
			document.getElementById('clock').innerHTML=d.toLocaleTimeString();
		}
		function welcome(){
			if("<?php echo $name;?>"!="error"){
				var nm = "<?php echo $name;?>";
				var temp = nm.split(" ");
				alert("Welcome, "+temp[0]);
			}
		}
	</script>
	</head>
	<body onload="welcome()" style="background-image:url('<?php if(isset($_SESSION['bgimg'])){echo $_SESSION['bgimg'];}?>')">
		<div id="wrapper">
		<div id="clock"></div>
		<button id="logout" onclick="window.location.href='scripts/closeevents.php'">Exit</button>
		<center>
			<div id="titleimg">
				<img src="images/header.png" id="headerimg"/>
			</div>
			<div id="formcontainer" style="background-image:url('images/formback.jpg')">
				<form id="checkin" action="scripts/setattendees.php" method="POST">
					<input type="text" name="fullname" placeholder="Full Name" required="required"/><br/>
					<input type="email" name="email" placeholder="Email ID" required="required"/><br/>
					<input type="text" name="college" placeholder="College" required="required"/><br/>
					<select name="faculty" id="fac" onblur="checkFac()">
						<option value="-1">&nbsp;&nbsp;Faculty</option>
						<option value="BIM">&nbsp;&nbsp;BIM</option>
						<option value="BSc.CSIT">&nbsp;&nbsp;BSc.CSIT</option>
						<option value="BBA">&nbsp;&nbsp;BBA</option>
						<option value="BBS">&nbsp;&nbsp;BBS</option>
					<select>&nbsp;&nbsp;
					<select name="level" id="lvl" onblur="checkLvl()">
						<option value="-1">&nbsp;&nbsp;Level</option>
					<select><br/>
					<span id="err" style="padding-bottom:8px;"></span><br/>
					<input type="Submit" value="Check In">
				</form>
			</div>
			<div id="footer">
				<p>We sincerely thank you for attending this event.</p>
				<p>Prime IT Club, Prime College.</p>
			</div>
		</center>
		</div>
	</body>
</html>