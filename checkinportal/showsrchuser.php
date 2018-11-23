<?php
	require("scripts/userdata.php");
	session_start();
	if(!isset($_SESSION['lguser'])){
		header("Location:index.html");
	}
	$imgupguide="Only JPG, PNG & GIF files supported \nPlease upload square photos if possible.";
	if(null!== $_SESSION['srch_user']->getProfile_img()){
		$imgadr="images/profilepics/".$_SESSION['srch_user']->getUsername().".".$_SESSION['srch_user']->getProfile_img();
	}else{
	if(strtolower($_SESSION['srch_user']->getSex())=="male"){
		$imgadr="images/profileavatarmale.png";
	}else{
		$imgadr="images/profileavatarfemale.png";
	}
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $_SESSION["srch_user"]->getUsername()." - Profile"?></title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<style type="text/css">
		#dbmake, #usrnm, input[type=password]{
			width:49%;
		}
		#email{
			width:98.5%;
		}
		#un{
			font-size:1.5em;
			color:white;
			opacity:0.9;
			font-weight:550;
		}
	</style>
	<script src="scripts/jquery.js"></script>
	<script>
		$(document).ready(function(){
			$("#backtoevents").click(function(){
				//$("#titleimg").fadeOut(450);
				$("#profile-prt-1").fadeOut(800);
				$("#profile-prt-2").fadeOut(800);
				setTimeout(fadeit,850);
				function fadeit(){
					$("#backtoevents").fadeOut(500);
					setTimeout(goBack,500);
				}
				function goBack(){
					window.location.href="people.php";
				}
			});
		});
	</script>
	</head>
	<body style="background-image:url('<?php if(isset($_SESSION['bgimg'])){echo $_SESSION['bgimg'];}?>')">
		<div id="wrapper">
			<div id="backtoevents"><img src="images/down.png"/>&nbsp;&nbsp;Back</div>
			<div id="downyougo"><img src="images/down.png"/></div>
		<div id="bodyif">
		<center>
			<div id="titleimg">
				<!--<img src="images/header.png" id="headerimg"/>--><br/><br/>
			</div>
		</center>
			<div id="profile-prt-1" style="float:right; margin: 8vh 15vw 0 0">
			<div id="profile-image-container" title="<?php if(null!== $_SESSION['srch_user']->getProfile_img()){echo 'Hopefully It\'s you..';}else{echo "Profile Pic Not Set";}?>">
				<img src="<?php echo $imgadr;?>" id="profileimg" align="center"/>
			</div>
			<span id="added-date">Since: <?php echo date("Y-m-d",strtotime($_SESSION['srch_user']->getAdded_date()));?></span><br/>
			</div>
			<div id="profile-prt-2" style="float:left; width:50vw; margin-left:5vw;">
				<span id="urname"><?php echo $_SESSION['srch_user']->getFname()." ".$_SESSION['srch_user']->getLname();?></span><br/>
				<span id="un">&nbsp;&nbsp;&nbsp;&nbsp;(&nbsp;<?php echo $_SESSION['srch_user']->getUsername();?>&nbsp;)</span>
				<div id="table-container">
				<table id="userinfo">
					<tr>
					<td><img src="images/country-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;Country--></td>
					<td><?php echo $_SESSION['srch_user']->getCountry()?></td>
					</tr>
					<tr>
					<td><img src="images/dob-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;D.O.B--></td>
					<td><?php echo $_SESSION['srch_user']->getDob()?></td>
					</tr>
					<tr>
					<td><img src="images/gender-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;Gender--></td>
					<td><?php echo strtoupper($_SESSION['srch_user']->getSex())?></td>
					</tr>
					<tr>
					<td><img src="images/phone-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;Phone No.--></td>
					<td><?php echo $_SESSION['srch_user']->getPhone_no()?></td>
					</tr>
					<tr>
					<td><img src="images/email-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;E-Mail--></td>
					<td><?php echo $_SESSION['srch_user']->getEmail()?></td>
					</tr>
					<tr>
					<td><img src="images/address-icon.png"><!--&nbsp;&nbsp;&nbsp;&nbsp;Address--></td>
					<td><?php echo $_SESSION['srch_user']->getAddress()?></td>
					</tr>
				</table>
				</div>
			</div>
		</div>
		</div>
	</body>
</html>