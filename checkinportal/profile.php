<?php
	require("scripts/userdata.php");
	session_start();
	if(!isset($_SESSION['lguser'])){
		header("Location:index.php");
	}
	$imgupguide="Only JPG, PNG & GIF files supported \nPlease upload square photos if possible.";
	if(null!== $_SESSION['lguser']->getProfile_img()){
		$imgadr="images/profilepics/".$_SESSION['lguser']->getUsername().".".$_SESSION['lguser']->getProfile_img();
	}else{
	if(strtolower($_SESSION['lguser']->getSex())=="male"){
		$imgadr="images/profileavatarmale.png";
	}else{
		$imgadr="images/profileavatarfemale.png";
	}
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $_SESSION["lguser"]->getUsername()." - Profile"?></title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<link type="text/css" rel="stylesheet" href="stylesheets/updatesec.css">
	<style type="text/css">
		#dbmake, #usrnm, input[type=password]{
			width:49%;
		}
		#email{
			width:98.5%;
		}
		button[type=submit]{
			margin-top:2vh;
		}
	</style>
	<script src="scripts/jquery.js"></script>
	<script>
	var counter=0,counter1=0;
		$(document).ready(function(){
			$("#menubtn").click(function(){
				if(counter==0){
					counter+=1;
					$("#urname").fadeOut("slow");
					$("#table-container").fadeOut("slow");
					setTimeout(rest, 500);
					function rest(){
					document.getElementById("table-container").style.visibility="hidden";
					$("#bodyif").animate({
						width: '82%'
					});
					$("#menuif").animate({
						width: '18%'
					});
					$("#menubtn").animate({
						right: '19vw'
					});
					$("#notfbtn").animate({
						right: '19vw'
					});
					$("#downyougo").animate({
						right: '+=10vw'
					});
					$("#contents").fadeIn(500);
					$("#urname").fadeIn("slow");
					}
				}else{
					counter=0;
					$("#urname").fadeOut("slow");
					setTimeout(rest, 500);
					function rest(){
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
					setTimeout(showtable, 600);
					}
				}
			});
			$("#bodyif").click(function(){
				if(counter!=0){
					counter=0;
					$("#urname").fadeOut("slow");
					setTimeout(rest, 500);
					function rest(){
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
					setTimeout(showtable, 600);
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
		function showtable(){
			document.getElementById("table-container").style.visibility="visible";
			$("#urname").fadeIn("slow");
			$("#table-container").fadeIn("slow");
		}
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
		<!-- The Modal -->
		<div id="id01" class="modal">

		<!-- Modal Content -->
		<form class="modal-content animate" action="scripts/updateprofile.php" method="POST" enctype="multipart/form-data">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		<div class="imgcontainer">
		<img src="<?php echo $imgadr;?>" alt="Avatar" class="avatar"><br/><br/>
		<label for="profileimage" title="<?php echo $imgupguide;?>">Change Pic&nbsp;&nbsp;&#9998;</label>
		<input type="file" name="profileimage" id="profileimage" accept="image/*"/>
		</div>
		<center>
		<div class="container">
		<input type="text" value="<?php echo $_SESSION['lguser']->getUsername();?>" name="uname" id="usrnm">&nbsp;<input type="password" placeholder="New Password" name="psw" id="psswrd"><br/>
		<input type="text" value="<?php echo $_SESSION['lguser']->getFname()." ". $_SESSION['lguser']->getLname();?>" name="fname" id="usrnm" title="Leave a space between first and last name.">&nbsp;<input type="number" value="<?php echo $_SESSION['lguser']->getPhone_no();?>" name="phn" id="usrnm"><br/>
		<input type="email" value="<?php echo $_SESSION['lguser']->getEmail();?>" name="email" id="email"><br/>
		<input type="text" value="<?php echo $_SESSION['lguser']->getAddress();?>" name="addr" id="email"><br/>
		</div> 
		</center>
		<div style="background-color: rgba(0,0,0,0.3); height:8vh">
			<button class="updatebtn" style="width: 8vw; border: none; border-radius: 3px; padding: 10px 18px; height:auto;" type="submit">Update</button>
			<button onclick="document.getElementById('id01').style.display='none'" type="reset" class="cancelbtn">Cancel</button>
		</div>
		</form>
		</div>

		<!--body-->
		<div id="foruser">Hey, <?php if(isset($_SESSION['lguser']))echo $_SESSION['lguser']->getUsername();?></div>
		<div id="wrapper">
			<span id="menubtn"><img src="images/menubtn1.png" id="menuicon" title="Show Menu"/></span>
			<div id="notfbtn"><img src="images/notification_icon.png" id="notficon" title="Show Messages"/>
			<div class="messages">
				<a class="closeMessages">&times;</a>
				<h1>Messages</h1>
			</div>
		</div>
			<div id="downyougo"><img src="images/down.png"/></div>
		<div id="bodyif">
		<div id="clock" title="Current Time"></div>
		<center>
			<div id="titleimg">
				<!--<img src="images/header.png" id="headerimg"/>--><br/><br/><br/>
			</div>
		</center>
			<div id="profile-prt-1">
			<div id="profile-image-container" title="<?php if(null!== $_SESSION['lguser']->getProfile_img()){echo 'Hopefully It\'s you..';}else{echo "Profile Pic Not Set";}?>">
				<img src="<?php echo $imgadr;?>" id="profileimg" align="center"/>
			</div>
			<span id="added-date">Since: <?php echo date("Y-m-d",strtotime($_SESSION['lguser']->getAdded_date()));?></span><br/>
			<div id="editprofile" onclick="document.getElementById('id01').style.display='block'" title="Edit Profile"><img src="images/edit-icon.png"><span>&nbsp;Edit<span></div>
			</div>
			<div id="profile-prt-2">
				<span id="urname"><?php echo $_SESSION['lguser']->getFname()." ".$_SESSION['lguser']->getLname();?></span><br/>
				<div id="table-container">
				<table id="userinfo">
					<tr>
					<td><img src="images/country-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;Country--></td>
					<td><?php echo $_SESSION['lguser']->getCountry()?></td>
					</tr>
					<tr>
					<td><img src="images/dob-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;D.O.B--></td>
					<td><?php echo $_SESSION['lguser']->getDob()?></td>
					</tr>
					<tr>
					<td><img src="images/gender-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;Gender--></td>
					<td><?php echo strtoupper($_SESSION['lguser']->getSex())?></td>
					</tr>
					<tr>
					<td><img src="images/phone-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;Phone No.--></td>
					<td><?php echo $_SESSION['lguser']->getPhone_no()?></td>
					</tr>
					<tr>
					<td><img src="images/email-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;E-Mail--></td>
					<td><?php echo $_SESSION['lguser']->getEmail()?></td>
					</tr>
					<tr>
					<td><img src="images/address-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;Address--></td>
					<td><?php echo $_SESSION['lguser']->getAddress()?></td>
					</tr>
				</table>
				</div>
			</div>
		</div>
		<div id="menuif">
			<div id="contents">
				<div id="home" onclick="window.location.href='home.php'"><img src="images/homeicon.png">&nbsp;&nbsp;Home</div><br/>
				<div id="profile" style="opacity:0.4"><img src="images/profileicon.png">&nbsp;&nbsp;Profile</div><br/>
				<div id="people" onclick="window.location.href='people.php'"><img src="images/peopleicon.png">&nbsp;&nbsp;People</div><br/>
				<div id="events" onclick="window.location.href='events.php'"><img src="images/eventicon.png">&nbsp;&nbsp;Events</div><br/>
				<div id="addevent" onclick="window.location.href='startevent.php'"><img src="images/addeventicon.png">&nbsp;&nbsp;Start Event</div>
				<div id="lgout" onclick="window.location.href='scripts/logout.php'"><img src="images/logouticon.png">&nbsp;&nbsp;Log Out</div><br/>
			</div>
		</div>
		</div>
	</body>
</html>