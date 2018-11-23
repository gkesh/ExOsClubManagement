<?php 
	require("scripts/userdata.php");
	session_start();
	if(!isset($_SESSION['lguser'])){
		header("Location:index.php");
	}
	if(isset($_SESSION['eventname'])){
		session_destroy();
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Start Event</title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<script src="scripts/jquery.js"></script>
	<script>
	var counter=0,counter1=0;
		$(document).ready(function(){
			$("#menubtn").click(function(){
				if(counter==0){
					$("#bodyif").animate({
						width: '82%'
					});
					$("#menuif").animate({
						width: '18%'
					});
					$("#contents").fadeIn(500);
					$("#menubtn").animate({
						right: '+=18vw'
					});
					$("#notfbtn").animate({
						right: '+=18vw'
					});
				counter+=1;
				}else{
					$("#contents").fadeOut(500);
					$("#menuif").animate({
						width: '0%'
					});
					$("#bodyif").animate({
						width: '100%'
					});
					$("#menubtn").animate({
						right: '1vw'
					});
					$("#notfbtn").animate({
						right: '1vw'
					});
				counter=0;
				}
			});
			$("#bodyif").click(function(){
				if(counter!=0){
					$("#contents").fadeOut(500);
					$("#menuif").animate({
						width: '0%'
					});
					$("#bodyif").animate({
						width: '100%'
					});
					$("#menubtn").animate({
						right: '1vw'
					});
					$("#notfbtn").animate({
						right: '1vw'
					});
					counter=0;
				}
			});
			$("#notfbtn").click(function(){
				if(counter1==0){
					document.getElementById("notfbtn").style="z-index:1";
					$("#notfbtn").animate({
						width: "+=20vw",
						height: "+=40vh",
						borderRadius: "-=48%"
					},300);
					$("#notficon").css('display','none');
					setTimeout(more,300);
					function more(){
						$(".messages").fadeIn(100);
					}
					counter1=1;
				}
			});
			$(".closeMessages").click(function(){
				$("#notfbtn").fadeOut(300);
				setTimeout(moreBack,350);
				function moreBack(){
					$(".messages").css('display','none');
					$("#notfbtn").css('width','3%');
					$("#notfbtn").css('height','auto');
					$("#notfbtn").css('border-radius','50%');
					$("#notficon").css('display','block');
					setTimeout(moreAlso,350);
				}
				function moreAlso(){
					counter1=0;
					$("#notfbtn").fadeIn(200);
				}
			});
		});
	</script>
	<script type="text/javascript" language="javascript">
	setInterval(clock,1000);
		function clock(){
			var d = new Date();
			document.getElementById('clock').innerHTML=d.toLocaleTimeString();
		}
	</script>
	</head>
	<body style="overflow:hidden;background-image:url('<?php if(isset($_SESSION['bgimg'])){echo $_SESSION['bgimg'];}?>')">
		<div id="wrapper">
		<div id="foruser">Hey, <?php if(isset($_SESSION['lguser']))echo $_SESSION['lguser']->getUsername();?></div>
		<span id="menubtn"><img src="images/menubtn1.png" id="menuicon" title="Show Menu"/></span>
		<div id="notfbtn"><img src="images/notification_icon.png" id="notficon" title="Show Messages"/>
			<div class="messages">
				<a class="closeMessages">&times;</a>
				<h1>Messages</h1>
			</div>
		</div>
		<div id="bodyif">
		<div id="clock" title="Current Time"></div>
		<center>
			<div id="titleimg">
				<!--<img src="images/header.png" id="headerimg"/>--><br/><br/><br/><br/>
			</div>
			<div id="formcontainer" style="background-image:url('images/formback.jpg')">
				<form id="checkin" action="scripts/createevent.php" method="POST">
					<input type="text" name="eventname" placeholder="Event Title" required="required"/><br/><br/>
					<input type="text" name="location" placeholder="Event Location" required="required"/><br/><br/>
					<input type="text" name="speakers" placeholder="Event Speakers" required="required"/><br/><br/>
					<input type="Submit" value="Start Event">
				</form>
			</div>
			</center>
		</div>
		<div id="menuif">
			<div id="contents">
				<div id="home" onclick="window.location.href='home.php'"><img src="images/homeicon.png">&nbsp;&nbsp;Home</div><br/>
				<div id="profile" onclick="window.location.href='profile.php'"><img src="images/profileicon.png">&nbsp;&nbsp;Profile</div><br/>
				<div id="people" onclick="window.location.href='people.php'"><img src="images/peopleicon.png">&nbsp;&nbsp;People</div><br/>
				<div id="events" onclick="window.location.href='events.php'"><img src="images/eventicon.png">&nbsp;&nbsp;Events</div><br/>
				<div id="addevent" style="opacity:0.4"><img src="images/addeventicon.png">&nbsp;&nbsp;Start Event</div>
				<div id="lgout" onclick="window.location.href='scripts/logout.php'"><img src="images/logouticon.png">&nbsp;&nbsp;Log Out</div><br/>
			</div>
		</div>
		</div>
	</body>
</html>