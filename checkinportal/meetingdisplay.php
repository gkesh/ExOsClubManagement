<?php
  require_once("scripts/userdata.php");
	require_once("scripts/meetingdata.php");
	session_start();
	if(!isset($_SESSION['lguser'])){
		header("Location:index.html");
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Events</title>
    <style media="screen">
      .content>p{
          font-family: "Lucida Fax";
          width: 90%;
          text-align: justify;
      }
      .popup{
          width: 50vw;
          overflow: auto;
      }
    </style>
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
					window.location.href="startmeeting.php";
				}
			});
		});
	</script>
	</head>
	<body style="background-image:url('<?php if(isset($_SESSION['bgimg'])){echo $_SESSION['bgimg'];}?>')">
		<div id="popup1" class="overlay" style="z-index:1">
		<div class="popup">
			<h2><img src="images/plan-icon.png">&nbsp;Meeting Details</h2>
			<a class="close" href="#">&times;</a>
			<center>
			<div class="content">
				<?php
					$my_file = fopen($_SESSION['srch_meeting']->getDetails(),"r") or die("Unable to open details file!!");
          echo "<p>";
          while(!feof($my_file)){
            echo fgets($my_file)."<br/>";
          }
          echo "</p>";
          fclose($my_file);
				?>
			</div>
    </center>
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
				<td colspan="2"><h1 style="font-weight:lighter; margin-top:5vh; margin-bottom:5vh" id="urname"><?php echo $_SESSION["srch_meeting"]->getTitle();?></h1></td>
				</tr>
				<tr id="eventdata">
					<td><img src="images/address-icon.png"> </td><td> <?php echo $_SESSION["srch_meeting"]->getLocation();?></td>
				</tr>
				<tr id="eventdata">
					<td><img src="images/eventicon.png"> </td><td> <?php echo $_SESSION["srch_meeting"]->getMeetingDate();?></td>
				</tr>
				<tr id="eventdata">
					<td><img src="images/login-icon.png" ></td><td> <?php echo $_SESSION["srch_meeting"]->getStartTime()." - ". $_SESSION["srch_meeting"]->getEndTime();?></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top:5vh"><center><button class="showattendeelist" onclick="location.href='#popup1'"><span>Meeting Details</span></button></center></td>
				</tr>
			</table>
			</div>
		</center>
		</div>
		</div>
		</div>
	</body>
</html>
