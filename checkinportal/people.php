
<?php
	require("scripts/userdata.php");
	session_start();
	if(!isset($_SESSION['lguser'])){
		header("Location:index.php");
	}
	$fadeinevent ="$('#wrapper').fadein(400);";
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>People</title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<script src="scripts/jquery.js"></script>
	<script>
	var counter=0, counter1=0;
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
			$(window).click(function(event){
				if(event.target!=document.getElementById("searchevents")){
					if(event.target!=document.getElementById("searcheventsbar")){
						if(event.target!=document.getElementById("search-results")){
						clearBox();
						}
					}
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
		
	//For Search
	//Using AJAX
	
	function searchUserData(){
		var str = document.getElementById("searcheventsbar").value.toLowerCase();
		if(str!=""){
		var xhr;
		if (window.XMLHttpRequest) { // Mozilla, Safari, ...
			xhr = new XMLHttpRequest();
		} else if (window.ActiveXObject) { // IE 8 and older
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
		var data = "reqstr=" + str;
		xhr.open("POST", "scripts/searchpeople.php", true); 
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
		xhr.send(data);
		xhr.onreadystatechange = display_data;
		function display_data() {
			if (xhr.readyState == 4) {
				if (xhr.status == 200) {  
					var res = xhr.responseText.split("\n");
					var topage="";
					for(var i=0; i<res.length-1;i++){
						var item = res[i].split("&");
						var img;
						if(item[2]=="#"){
							img = "<img src='images/profileicon.png' id='searchprofile' align='left' style='margin-right:0.5vw;'>";
						}else{
							img = "<img src='images/profilepics/"+item[1]+"."+item[2]+"' id='searchprofile' align='left' style='margin-right:0.5vw;'>";
						}
						if(item[1]=="<?php echo $_SESSION['lguser']->getUsername()?>"){
							item[1]+="&nbsp;[You]";
						}
						topage=topage+"<div onclick=\"showPeople('"+item[1]+"','"+"user"+"')\" id='ext-res'><span class='floatleft'>"+img+item[0]+"</span><span class='floatright'>"+item[1]+"</span></div><br/>";
					}
					document.getElementById("searchevents").style="background-color:white";
					$("#search-results").fadeIn(800);
					document.getElementById("search-results").innerHTML=topage;
				} else {
					alert('There was a problem with the request.');
				}
			}
		}
		}else{
			clearBox();
		}
	}
	
	//To clear the box
	function clearBox(){
		$("#search-results").fadeOut(300);
		document.getElementById("search-results").innerHTML="";
		document.getElementById("searchevents").style="background:none";
	}
	function showPeople(name,ac_type){
		var regEx = new RegExp("You","g");
		if(null!=regEx.exec(name)){
			window.location = "profile.php";
		}else{
			if(ac_type=="user"){
				window.location = "scripts/getuserdata.php?unm="+name;
			}else{
				window.location = "scripts/getattendeedata.php?anm="+name;
			}
		}
	}
	</script>
	</head>
	<body style="overflow:hidden;background-image:url('<?php if(isset($_SESSION['bgimg'])){echo $_SESSION['bgimg'];}?>')">
		<div id="foruser">Hey, <?php if(isset($_SESSION['lguser']))echo $_SESSION['lguser']->getUsername();?></div>
		<div id="wrapper">
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
				<!--<img src="images/header.png" id="headerimg"/>--><br/><br/><br/><br/><br/>
			</div>
			<div id="searchevents">
				<input type="text" name="search" style="margin-top:0; background-image:url('images/search-icon.png');" id="searcheventsbar" placeholder="Search Users..." onfocus="searchUserData()" onkeyup="searchUserData()"/>
				<div id="search-results" style="padding-left:1vw">
			</div>
		</center>
		</div>
		<div id="menuif">
			<div id="contents">
				<div id="home" onclick="window.location.href='home.php'"><img src="images/homeicon.png">&nbsp;&nbsp;Home</div><br/>
				<div id="profile" onclick="window.location.href='profile.php'"><img src="images/profileicon.png">&nbsp;&nbsp;Profile</div><br/>
				<div id="people" style="opacity:0.4"><img src="images/peopleicon.png">&nbsp;&nbsp;People</div><br/>
				<div id="events" onclick="window.location.href='events.php'"><img src="images/eventicon.png">&nbsp;&nbsp;Events</div><br/>
				<div id="addevent" onclick="window.location.href='startevent.php'"><img src="images/addeventicon.png">&nbsp;&nbsp;Start Event</div>
				<div id="lgout" onclick="window.location.href='scripts/logout.php'"><img src="images/logouticon.png">&nbsp;&nbsp;Log Out</div><br/>
			</div>
		</div>
		</div>
	</body>
</html>