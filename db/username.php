<?php
   require_once('configuration.php');

   // Create connection
   $con = new mysqli($servername, $username, $password, $dbname);

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
	
   $userid = $_GET['userid'];
   $result = mysqli_query($con,"SELECT userid FROM `user` where 
   userid='$userid'");
   $row = mysqli_fetch_array($result);
   $data = $row[0];
   if($data){
    echo $data;
   }
	
   mysqli_close($con);
?>