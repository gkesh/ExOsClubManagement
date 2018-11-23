<?php
	require_once("scripts/userdata.php");
	require_once("scripts/attendeedata.php");
	session_start();
	if(!isset($_SESSION['lguser'])){
		header("Location:index.html");
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Events</title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<link type="text/css" rel="stylesheet" href="stylesheets/attendeelist.css">
	<script src="scripts/jquery.js"></script>
	<script>
		$(document).ready(function(){
			$("#backtoevents").click(function(){
				$("#titleimg").fadeOut(450);
				$("#event-data-table").fadeOut(400);
				$("#destroy").animate({
					width: '-=100vw',
					height: '-=100vh'
				},600);
				setTimeout(fadeit,650);
				function fadeit(){
					$("#backtoevents").fadeOut(400);
					setTimeout(goBack,500);
				}
				function goBack(){
					window.location.href="events.php";
				}
			});
		});
	</script>
	</head>
	<body style="background-image:url('<?php if(isset($_SESSION['bgimg'])){echo $_SESSION['bgimg'];}?>')">
		<div id="popup1" class="overlay" style="z-index:1">
		<div class="popup">
			<h2><img src="images/attendee-icon.png">&nbsp;Attendee List</h2>
			<a class="close" href="#">&times;</a>
			<div class="content">
			<center>
				<?php
					if(isset($_SESSION['attendeeData'])){
					echo "<table class='datatable'>";
					echo "<tr>";
					echo "<th>Name</th>";
					echo "<th>Email</th>";
					echo "<th>Level</th>";
					echo "<th>Faculty</th>";
					echo "<th>College</th>";
					echo "</tr>";
					foreach($_SESSION['attendeeData'] as $attendees){
						echo "<tr>";
						echo "<td>".$attendees->getName()."</td>";
						echo "<td>".$attendees->getEmail()."</td>";
						echo "<td>".$attendees->getLevel()."</td>";
						echo "<td>".$attendees->getFaculty()."</td>";
						echo "<td>".$attendees->getCollege()."</td>";
						echo "</tr>";
					}
					echo "</table>";
					}else{
						echo "Sorry, No data found!";
					}
				?>
			</center>
			</div>
		</div>
		</div>
		<div id="wrapper">
		<div id="destroy">
		<div id="backtoevents"><img src="images/down.png"/>&nbsp;&nbsp;Back</div>
		<div id="foruser">Hey, <?php if(isset($_SESSION['lguser']))echo $_SESSION['lguser']->getUsername();?></div>
		<div id="bodyif">
		<div id="clock"></div>
		<center>
			<div id="titleimg">
				<!--<img src="images/header.png" id="headerimg"/>-->
			</div>
			<div id="event-info" style="opacity:0.9">
			<table id="event-data-table">
				<tr>
				<td colspan="2"><h1 style="font-weight:lighter; margin-top:5vh; margin-bottom:5vh" id="urname"><?php echo $_SESSION["s_event_name"];?></h1></td>
				</tr>
				<tr id="eventdata">
					<td><img src="images/speakers-icon.png" ></td><td> <?php echo $_SESSION["s_event_speakers"];?></td>
				</tr>
				<tr id="eventdata">
					<td><img src="images/address-icon.png"> </td><td> <?php echo $_SESSION["s_event_location"];?></td>
				</tr>
				<tr id="eventdata">
					<td><img src="images/eventicon2.png"> </td><td> <?php echo $_SESSION["s_event_date"];?></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top:5vh"><center><button class="showattendeelist" onclick="location.href='#popup1'"><span>Attendee List</span></button></center></td>
				</tr>
			</table>
			</div>
		</center>
		</div>
		</div>
		</div>
	</body>
</html>