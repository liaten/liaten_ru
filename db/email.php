<?php
   require_once('configuration.php');
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
	
   $type = $_GET['type'];
   $typeValue = $_GET['typeValue'];

   $result = mysqli_query($con,"SELECT email FROM `user` where email = '".$email."'");
   $row = mysqli_fetch_array($result);
   $data = $row[0];
   $response = array();
   
   if($data){
      $response['success']=true;
      $response['type']='email';
      $response['email'] = $data;
   }
   else{
      $response['success']=false;
      $response['type']='email';
      $response['email'] = '';
   }
   echo json_encode($response, JSON_UNESCAPED_UNICODE);
   mysqli_close($con);
?>