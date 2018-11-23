<?php
  $users = explode(",",$_POST["reqstr"]);
  //create a connection
  $con = mysqli_connect('localhost','root','','ict_club');

  //Checking Connection
  if (!$con) {
    die('Connection Failed: ' . mysqli_error($con));
  }

  mysqli_select_db($con,"ict_club");
  $names = array();
  foreach ($users as $user) {

      $sql="Select first_name, last_name from users where username = '".trim($user)."'";

      $row = mysqli_fetch_row(mysqli_query($con,$sql));

      $names[sizeof($names)] = $row['first_name']." ".$row['last_name'];
  }

  foreach ($names as $name) {
    echo $name."\n";
  }
  mysqli_close($con);
?>
