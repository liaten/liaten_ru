<?php
   require_once('configuration.php');

   // Create connection
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
	
   $userid = $_GET['userid'];
   $result = mysqli_query($con,"SELECT userid FROM `user` where 
   userid='$userid'");
   $row = mysqli_fetch_array($result);
   $data = $row[0];
   $response = array();
   
   if($data){
      $response['success']=true;
      $response['type']='userid';
      $response['userid'] = $data;
   }
   else{
      $response['success']=false;
   }
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	
   mysqli_close($con);
?>