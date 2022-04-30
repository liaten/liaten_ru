<?php
   require_once('configuration.php');

   // Create connection
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
	
   $surname = $_POST['surname'];
   $name = $_POST['name'];
   $patronymic = $_POST['patronymic'];
   $phone = $_POST['phone'];
   $date = $_POST['date'];
   $email = $_POST['email'];
   $userid = $_POST['userid'];
   $passw = $_POST['password'];
   $result = mysqli_query($con,"INSERT INTO `user` (surname, name, patronymic, phone_number, birth_date, email, userid, password) VALUES ($surname, $name, $patronymic, $phone, $date, $email, $userid, $passw)");
   $row = mysqli_fetch_array($result);
   $data = $row[0];
   $response = array();
   
   if($data){
      $response['success']=true;
      $response['type']='user';
      $response['user'] = $data;
   }
   else{
      $response['success']=false;
   }
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	
   mysqli_close($con);
?>