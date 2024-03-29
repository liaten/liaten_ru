<?php
   require_once('configuration.php');
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");
   
   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
	
   $type = $_GET['type'];
   $typeValue = $_GET['typeValue'];
   $searchable = $_GET['searchable'];
   $table = $_GET['table'];

   $SQL = "SELECT ".$searchable." FROM `".$table."` where ".$type."='".$typeValue."'";
   $result = mysqli_query($con,$SQL);
   $row = mysqli_fetch_array($result);
   $data = $row[0];
   $response = array();
   
   if($data){
      $response['success']=true;
      $response['type']=$searchable;
      $response[$searchable] = $data;
   }
   else{
      $response['success']=false;
      $response['type']=$searchable;
      $response['typeValue']=$typeValue;
      $response['searchable']=$searchable;
      $response['table']=$table;
      $response['sql']=$SQL;
   }
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
   mysqli_close($con);
?>