<?php
	require("scripts/userdata.php");
	session_start();
	if(!isset($_SESSION['lguser'])){
		header("Location:index.php");
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Home</title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<link type="text/css" rel="stylesheet" href="stylesheets/attendeelist.css">
	<script src="scripts/jquery.js"></script>
	<script type="text/javascript" language="javascript">
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
					$("#downyougo").animate({
						right: '+=10vw'
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
					$("#downyougo").animate({
						right: '50vw'
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
					$("#downyougo").animate({
						right: '50vw'
					});
					counter=0;
				}
			});
			$("#downyougo").click(function(){
				location.href='#popup1';
				$("#pop").animate({
					bottom: '0'
				},500);
			});
			$(".close").click(function(){
				$("#pop").animate({
					bottom: '-=100vh'
				},500);
				setTimeout(erase,500);
				function erase(){
					location.href="#";
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
			$(".notfdivs").click(function(){
				function viewportToPixels(value) {
					var parts = value.match(/([0-9\.]+)(vh|vw)/)
					var q = Number(parts[1])
					var side = window[['innerHeight', 'innerWidth'][['vh', 'vw'].indexOf(parts[2])]]
					return side * (q/100)
				}
				var el = $(this);
				var curHght = el.height();
				if(curHght<viewportToPixels("1.8vw")){
					var autohght = el.css('height','auto').height();
					el.height(curHght).animate({
						height: autohght
					},100);
				}else{
					el.animate({
						height: '1.3vw'
					},100);
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
		<div id="foruser">Hey, <?php if(isset($_SESSION['lguser']))echo $_SESSION['lguser']->getUsername();?></div>
		<div id="downyougo" title="Show Notifications"><span id="vanishing-notf"><img src="images/updates-icon.png" width="12%" height="3%"/></span><br/><img src="images/down.png" width="12%" height="3%"/></div>
		<div id="notfbtn"><img src="images/notification_icon.png" id="notficon" title="Show Messages"/>
			<div class="messages">
				<a class="closeMessages">&times;</a>
				<h1>Messages</h1>
			</div>
		</div>
		<div id="wrapper">
			<span id="menubtn"><img src="images/menubtn1.png" id="menuicon" title="Show Menu"/></span>
		<div id="bodyif">
		<div id="clock" title="Current Time"></div>
		<center>
			<div id="titleimg">
				<!--<img src="images/header.png" id="headerimg"/>--><br/><br/><br/><br/>
			</div>
			<div id="iconcontainer">
				<div id="profile-container">
					<div id="img-container" title="Profile" onclick="window.location.href='profile.php'">
						<img src="images/profileicon.png"/>
					</div>
				</div>
				<div id="people-container">
					<div id="img-container" title="People" onclick="window.location.href='people.php'">
						<img src="images/peopleicon.png"/>
					</div>
				</div>
				<div id="events-container">
					<div id="img-container" title="Events" onclick="window.location.href='events.php'">
						<img src="images/eventicon2.png"/>
					</div>
				</div>
				<div id="add-event-container">
					<div id="img-container" title="Start an Event" onclick="window.location.href='startevent.php'">
						<img src="images/addeventicon2.png"/>
					</div>
				</div>
				<div id="plan-container">
					<div id="img-container" title="Meetings" onclick="window.location.href='startmeeting.php'">
						<img src="images/plan-icon.png"/>
					</div>
				</div>
			</div>
		</center>
		</div>
		<!--Notification Panel-->
		<div id="popup1" class="overlay" style="z-index:1;">
		<center>
		<div class="popup" style="bottom:-100vh" id="pop">
			<h2><!--<img src="images/notf-icon.png">--><span style="vertical-align:middle">Notifications</span></h2>
			<a class="close">&times;</a>
			<div class="content" style="max-height:70vh">
			<center>
				<?php
					try{
						$udata_i=$_SESSION['lguser']->getId();
						$con = mysqli_connect('localhost','root','','ict_club');
						$sql="SELECT * FROM notifications WHERE notf_recievers NOT LIKE '%($udata_i)%' ORDER BY notf_date DESC";
						$data = mysqli_query($con,$sql);
						foreach($data as $tbcols){
							$title=$tbcols['notf_title'];
							$dt=$tbcols['notf_date'];
							$details=$tbcols['notf_detail'];
							echo "
								<div class='notfdivs'>
									<div class='notftitles'>$title</div>
									<div class='notfdate'>$dt</div>
									<div class='notfdetails'>$details</div>
								</div>
								";

						}
					}catch(Exception $e){
						die("Error:: ".$e->getMessage());
					}
				?>
			</center>
			</div>
		</div>
		</center>
		</div>
		<!--Notification Panel End-->
		<div id="menuif">
			<div id="contents">
				<div id="home" style="opacity:0.4"><img src="images/homeicon.png">&nbsp;&nbsp;Home</div><br/>
				<div id="profile" onclick="window.location.href='profile.php'"><img src="images/profileicon.png">&nbsp;&nbsp;Profile</div><br/>
				<div id="people" onclick="window.location.href='people.php'"><img src="images/peopleicon.png">&nbsp;&nbsp;People</div><br/>
				<div id="events" onclick="window.location.href='events.php'"><img src="images/eventicon.png">&nbsp;&nbsp;Events</div><br/>
				<div id="addevent" onclick="window.location.href='startevent.php'"><img src="images/addeventicon.png">&nbsp;&nbsp;Start Event</div>
				<div id="lgout" onclick="window.location.href='scripts/logout.php'"><img src="images/logouticon.png">&nbsp;&nbsp;Log Out</div><br/>
			</div>
		</div>
		</div>
	</body>
</html>
