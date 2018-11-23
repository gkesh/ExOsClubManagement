<?php
	session_start();
	if(!file_exists("files/background-loc.txt")){
		$bglocfile = fopen("files/background-loc.txt","w");
		fwrite($bglocfile,"images/backgrounds/7.jpg");
	}else{
		if(0 == filesize("files/background-loc.txt")){
			$backgroundloc = "images/backgrounds/7.jpg";
			$_SESSION['bgimg']=$backgroundloc;
		}else{
			$bglocfile = fopen("files/background-loc.txt","r");
			$backgroundloc = fgets($bglocfile);
			if(!file_exists($backgroundloc)){
				$backgroundloc="images/backgrounds/7.jpg";
			}
			$_SESSION['bgimg']=$backgroundloc;
			fclose($bglocfile);
		}
	}
?>
<html>
	<head>
		<title>Cover</title>
	<link type="text/css" rel="stylesheet" href="stylesheets/indxstyl.css">
	<link type="text/css" rel="stylesheet" href="stylesheets/attendeelist.css">
	<script src="scripts/jquery.js"></script>
	<script>
		var isExpanded = false;
		$(document).ready(function(){
			$("#starton").click(function(){
				$("#starton").fadeOut("slow");
				setTimeout(rest, 500);
				function rest(){
				$("#logincontainer").animate({
					height: "30%",
					width: "20%"
				},"slow");
				document.getElementById("enterapp").style="display:block";
				$("#starton").fadeIn("slow");
				document.getElementById("starton").style="font-size:2vh";
				document.getElementById("starton").innerHTML="";
				$("#starton").fadeIn("slow");
				isExpanded=true;
				}
			});
			$(window).click(function(event){
				if(event.target!=document.getElementById("logincontainer")){
					if(event.target==document.getElementById("enterapp") || event.target==document.getElementById("login-user") || event.target==document.getElementById("login-psw"))
						return;
					if(isExpanded){
						$("#enterapp").fadeOut("slow");
						$("#starton").fadeOut("slow");
						setTimeout(rush, 500);
						function rush(){
							$("#logincontainer").animate({
								height: "5%",
								width: "10%"
							},"slow");
							document.getElementById("starton").style="font-size:2vw;";
							document.getElementById("starton").innerHTML="Enter";
							$("#starton").fadeIn("slow");
						}
						isExpanded=false;
					}
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
		//Cookie portion

		/*function setUserCookie() {
			if(!issetCookie()){
			var d = new Date();
			d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
			var expires = "expires="+d.toUTCString();
			var username = document.getElementById("login-user").value;
			var password = document.getElementById("login-psw").value;
			document.cookie = "username" + "=" + username + ";" + expires + ";path=/";
			document.cookie = "password" + "=" + password + ";" + expires + ";path=/";
			}
		}
		function getData(){
			if(getCookie("username")!="" && getCookie("password")!=""){
				document.getElementById("login-user").value=getCookie("username");
				document.getElementById("login-psw").value=getCookie("password");
			}
		}
		function getCookie(cname) {
			if(issetCookie()){
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
			}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
			}
		}

		function issetCookie() {
			var user = getCookie("username");
			if (user != "") {
				return true;
			} else {
				return false;
			}
		}	*/
	</script>
	</head>
	<body style="background-image:url('<?php echo $backgroundloc; ?>')">
		<div id="popup1" class="overlay" style="z-index:1">
		<div class="popup" style="width:35vw; height:70vh">
			<h2>Wallpapers</h2>
			<a class="close" href="#">&times;</a>
			<div class="content">
			<center>
				<?php
					$count=0;
					$handle = opendir(dirname(realpath(__FILE__)).'/images/backgrounds/');
					echo "<table class='wallpapers'><tr>";
					while($file = readdir($handle)){
						if($count==3){
							echo "</tr><tr>";
							$count=0;
						}
						if($file !== '.' && $file !== '..'){
							$back = "'images/backgrounds/$file'";
							echo "<td class='img-td'><div style=\"background-image:url(".$back.")\" border='0' class='wallpaper-td'/><div class='perf-wall'><img src='images/choose-icon.png' onclick='location.href=\"scripts/changebackground.php?bgimg=images/backgrounds/".$file."\"'><img src='images/cross-icon.png' onclick='location.href=\"scripts/deletebackground.php?bgimg=../images/backgrounds/".$file."\"'></div></div>";
							$count++;
						}
					}
					if($count<3){
						echo "</tr>";
					}
					echo "</table>";
				?>
			</center>
			</div>
			<center>
			<div class="bgupload">
					<form class="imgupbg" name="bgupload" action="scripts/uploadbgimg.php" method="POST" enctype="multipart/form-data">
						<label for="bgimage" title="Upload only one at a time"><img src="images/bg-upload-icon.png"></label>
						<input type="file" name="bgimage" id="bgimage" accept="image/*"/>
						<script>
							//Auto-upload image
							$(function(){
								$("#bgimage").change(function(){
									var formdat = new FormData(document.querySelector(".imgupbg"));
									var xhr = new XMLHttpRequest();

									xhr.onload = function(){
										if(xhr.status === 200){
											location.reload();
										}
									}

									xhr.open("POST","scripts/uploadbg.php");
									xhr.send(formdat);
								});
							});
						</script>
					</form>
				</div>
			</center>
		</div>
		</div>
		<div id="wrapper" >
		<div class="regis"><img src="images/register-icon.png" title="Register" onclick="window.location.href='signup.html'"></div>
		<div class="help"><img src="images/help-icon.png" title="Help"></div>
		<div id="foruser" style="border:none; bottom:3vh" title="Change Wallpaper" onclick="location.href='#popup1'"><img src="images/wallpaper-icon.png"></div>
		<div id="bodyif">
		<div id="clock"></div>
		<center>
			<div id="titleimg">
				<img src="images/header.png" id="headerimg" style="visibility:hidden"/><br/>
			</div>
			<div id="logincontainer">
				<form name="enter" id="enterapp" action="scripts/logontoprofile.php" method="POST">
					<input type="text" name="username" placeholder="Username" id="login-user" required="required" onblur="setUserCookie()"/><br/>
					<input type="password" name="password" placeholder="&#x25cf;&#x25cf;&#x25cf;&#x25cf;&#x25cf;&#x25cf;&#x25cf;" id="login-psw" required="required" onblur="setUserCookie()"/><br/>
					<button type="Submit" style="background:none; opacity:0.9; padding:0" onclick="setUserCookie()"><img src="images/login-icon.png"/></button>
				</form>
				<span id="starton">Enter</span>
			</div>
			<div id="footer">
				<p>Sic. Parvis. Magna.</p>
			</div>
		</center>
		</div>
		</div>
	</body>
</html>
