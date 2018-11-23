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
		<title>Start Meeting</title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<style type="text/css">
		#formcontainer{
			background-image:url('images/formback.jpg');
			position:absolute;
			top:10vh;
			right:35%;
			display:none;
		}
		#searchevents{
			position:absolute;
			top:20vh;
			right:25vw;
		}
		#ext-res{
			height: 1.8vw;
			width: 90%;
			margin: 0;
		}
		#ext-res:hover{
			cursor: pointer;
		}
		.floatright{
			padding-right: 0;
			word-spacing: 2vh;
		}
	</style>
	<script src="scripts/jquery.js"></script>
	<script>
	var counter=0,counter1=0;
		$(document).ready(function(){
			$("#searchevents").css('display','none');
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
			$(".meetingstart").click(function(){
				$(".meetingstart").fadeOut(300);
				$(".meetingstart").css('display','none');
				setTimeout(showNext,300);
				function showNext(){
					$(".formdat").animate({
						width: "25vw",
						height: "30vh"
					});
					$(".formdat").css('display','block');
				}
			});
			$(".meetingsubmit").click(function(){
				if(document.getElementById('mtitle').value!="" && document.getElementById('mlocation').value!=""){
					$(".cover").animate({
							top: "-=150vh"
					},1000);
					setTimeout(showForm,1000);
					function showForm(){
						$("#formcontainer").css('display','block');
						$("#formcontainer").fadeIn(200);
						$(".iconhub").css('display','block');
						$(".iconhub").fadeIn(200);
					}
				}
			});

			$(".meetingsee").click(function(){
				$(".cover").animate({
						top: "-=150vh"
				},1000);
				setTimeout(showsrch,1000);
				function showsrch(){
					$("#searchevents").css('display','block');
					$("#searchevents").fadeIn(200);
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
		var meetingStartTime;
		var searching = false;
		function setSearching(){
			searching = true;
		}
		function setMeetingStartTime(time){
			meetingStartTime = time;
		}
		function sendData(){
			if(searching){
				location.reload();
			}else{
				document.dataForm.title.value=document.getElementById('mtitle').value;
				document.dataForm.location.value=document.getElementById('mlocation').value+"\n\n";
				document.dataForm.attendees.value="\n\n"+attendeesName+"\n\n";
				document.dataForm.start_time.value=meetingStartTime+"\n\n";
				document.dataForm.end_time.value= new Date().toLocaleTimeString();
				document.dataForm.date.value= "\n\n"+new Date().toLocaleDateString()+"\n\n";
				document.dataForm.usernames.value=present_attendees;
				document.dataForm.agendas.value+="\n\n";
				document.dataForm.summary.value+="\n\n";
				document.getElementById('checkin').submit();
			}
		}
	</script>
	<!--<script type="text/javascript" src="scripts/saveMeetingData.js"></script>-->
	</head>
	<body style="overflow:hidden;background-image:url('<?php if(isset($_SESSION['bgimg'])){echo $_SESSION['bgimg'];}?>')">
		<div id="wrapper">
		<div id="foruser">Hey, <?php if(isset($_SESSION['lguser']))echo $_SESSION['lguser']->getUsername();?></div>
		<div id="notfbtn"><img src="images/notification_icon.png" id="notficon" title="Show Messages"/>
			<div class="messages">
				<a class="closeMessages">&times;</a>
				<h1>Messages</h1>
			</div>
		</div>
		<div class="cover">
			<span class="homeret" onclick="location.href='home.php'"><img src="images/homeicon.png" alt="Home Icon"></span>
			<div class="cntbtn">
				<div class="formdat">
				<center>
					<input type="text" name="eventname" placeholder="Meeting Title" required="required" id="mtitle" onblur="setMeetingTitle(document.getElementById('mtitle').value)"/><br/>
					<input type="text" name="location" placeholder="Meeting Location" required="required" id="mlocation" onblur="setMeetingLocation(document.getElementById('mlocation').value)"/>
					<button class="meetingsubmit slide" onclick="setMeetingStartTime(new Date().toLocaleTimeString())"><div class='d2'>Let's Start</div></button>
				</center>
				</div>
				<button class="meetingstart stir">Start Meeting</button>
			</div>
			<div class="meetingsee" title="Look up Meetings" onclick="setSearching()">
				<img src="images/srchmeetings.png" class="seeit"/><br/>
				<center><img src="images/down.png" class="curtainsup"/></center>
			</div>
		</div>
		<div id="bodyif">
		<div id="clock" title="Current Time"></div>
		<button id="logout" onclick="sendData()">Done</button>
		<center>
			<div id="titleimg">
				<!--<img src="images/header.png" id="headerimg"/>--><br/><br/><br/><br/>
			</div>
			<div id="formcontainer">
				<form id="checkin" name="dataForm" action="scripts/saveMeetingDetails.php" method="POST">
					<textarea class="agendas" name="agendas" placeholder="Meeting Details"></textarea>
					<textarea class="summary" name="summary" placeholder="Summary"></textarea>
					<input type="hidden" name="title">
					<input type="hidden" name="location">
					<input type="hidden" name="attendees">
					<input type="hidden" name="start_time">
					<input type="hidden" name="end_time">
					<input type="hidden" name="date">
					<input type="hidden" name="usernames">
					<div class="attendence">

					</div>
					<script type="text/javascript">
						var attendeesName = "Attendees :\n\n";
						var present_attendees = "";
						function attendeePresent(e, name){
							var newUser = e.getElementsByClassName('floatright')[0].innerHTML;
							if(newUser.match(/<(.?)*>/)!=null){
								newUser = newUser.replace(/<(.?)*>/,"");
							}
							if(present_attendees.indexOf(newUser)==-1){
								present_attendees = present_attendees.concat(newUser+",");
								//Styling the attendence
								e.getElementsByClassName('floatright')[0].innerHTML = newUser + "<b>&#10004;</b>";
								e.style.color="rgb(206, 32, 41)";
								attendeesName = attendeesName.concat(e.getElementsByClassName('floatleft')[0].innerHTML.replace(/<(.?)*>/,"")+"\n");
							}else {
								present_attendees = present_attendees.replace(newUser+",","");
								attendeesName = attendeesName.replace(e.getElementsByClassName('floatleft')[0].innerHTML.replace(/<(.?)*>/,"")+"\n","");
								//unstyling the elements
								e.getElementsByClassName('floatright')[0].innerHTML = newUser;
								e.style.color="black";
							}
						}
						(function() {
							'use strict';
							var xhr;
							if (window.XMLHttpRequest) { // Mozilla, Safari, ...
								xhr = new XMLHttpRequest();
							} else if (window.ActiveXObject) { // IE 8 and older
								xhr = new ActiveXObject("Microsoft.XMLHTTP");
							}
							var data = "reqstr=all";
							xhr.open("POST", "scripts/searchpeople.php", true);
							xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							xhr.send(data);
							xhr.onreadystatechange = attendence_data;
							function attendence_data(){
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
											topage=topage+"<div id='ext-res' onclick='attendeePresent(this)'><span class='floatleft'>"+img+item[0]+"</span><span class='floatright'>"+item[1]+" </span></div><br/>";
										}
										document.getElementsByClassName('attendence')[0].innerHTML=topage;
									} else {
										alert('There was a problem with the request.');
									}
								}
							}
							$(".meetingstart").addEventListener("click",callbackFunc);
						})();
					</script>
				</form>
				<script type="text/javascript">
				$(document).ready(function(){
					$(".agendas").focus(function(){
						if(this.innerHTML==""){
							this.innerHTML="Agenda 1:\n";
						}
						var agCount = 2;
						this.addEventListener("keydown",function(e){
							if (e.ctrlKey  &&  e.altKey  &&  e.code === "KeyE") {
								$(".agendas").html($(".agendas").html().concat("\n\nAgenda "+agCount+":\n"));
								agCount++;
    					}
						});
					});
					$(".agendas").blur(function(){
						if(this.innerHTML=="Agenda 1:\n"){
							this.innerHTML="";
						}
					});
					$(".summary").focus(function(){
						if(this.innerHTML==""){
							this.innerHTML="Conclusion :\n";
						}
					});
					$(".summary").blur(function(){
						if(this.innerHTML=="Conclusion :\n"){
							this.innerHTML="";
						}
					});
				});
				</script>
			</div>
			<div class="attendencecheck">
			</div>
			<div class="iconhub">
				<div class="sai">
					<img src="images/attendence-icon.png" class="sai"/>
				</div>
				<div class="sagi">
					<img src="images/agendas-icon.png" class="sagi"/>
				</div>
				<div class="ssi">
					<img src="images/summary-icon.png" class="ssi"/>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#checkin").css("margin-bottom","0");
						$(".ssi").click(function(){
							if($('.summary').css('display') == 'none'){
									$('.agendas').css('display','none');
									$('.attendence').css('display','none');
									$('.summary').css('display','block');
							}
						});
						$(".sagi").click(function(){
							if($('.agendas').css('display') == 'none'){
									$('.agendas').css('display','block');
									$('.attendence').css('display','none');
									$('.summary').css('display','none');
							}
						});
						$(".sai").click(function(){
							if($('.attendence').css('display')=='none'){
								$('.attendence').css('display','block');
								$('.agendas').css('display','none');
								$('.summary').css('display','none');
							}
						});
					});
				</script>
			</div>
			<div id="searchevents">
				<input type="text" name="search" style="margin-top:0; background-image:url('images/search-icon.png');" id="searcheventsbar" placeholder="Search Meetings..." onfocus="searchUserData()" onkeyup="searchUserData()"/>
				<div id="search-results">
				</div>
			</div>
			<script type="text/javascript">
				function searchUserData(){
					var xhr;
					var str = document.getElementById("searcheventsbar").value.toLowerCase();
					if(str!=""){
						try{
							xhr = new XMLHttpRequest();
						}catch(e){
							try{
								xhr = new ActiveXObject("Msxml2.XMLHTTP");
							}catch(e){
								try{
									xhr = new ActiveXObject("Microsoft.XMLHTTP");
								}catch(e){
									alert("Request Failed!!");
									return false;
								}
							}
						}
						//Recieving data
						var data = "reqstr=" + str;
						xhr.open("POST" , "scripts/searchmeetings.php" , true);
						xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						xhr.send(data);
						xhr.onreadystatechange = display_data;
						function display_data(){
							if(xhr.readyState == 4 && xhr.status == 200){
								var res = xhr.responseText.split("\n");
								var topage="";
								for(var i=0; i<res.length-1;i++){
									var item = res[i].split(":");
									topage=topage+"<div onclick=\"showMeeting('"+item[0]+"')\"><span class='floatleft'>"+item[0]+"</span><span class='floatright' style='padding-right:3.8vw'>"+item[1]+"</span></div><br/>";
								}
								document.getElementById("searchevents").style="background-color:white";
								$("#search-results").fadeIn(800);
								document.getElementById("search-results").innerHTML=topage;
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

				function showMeeting(meetingname){
					window.location = "scripts/getmeetingsdata.php?mnm="+meetingname;
				}
			</script>
			</center>
		</div>

		</div>
	</body>
</html>
