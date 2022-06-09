<?php
require_once('configuration.php');
$con = new mysqli($servername, $username, $password, $dbname);
$con->set_charset("utf8");
if (!$con){
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}

$page = $_GET['page'];
$recsPerPage = $_GET['recsPerPage'];
$start = ($page != 1) ? $page * $recsPerPage - $recsPerPage : 0;
$date=date("Y-m-d",time());
$sql = "SELECT * FROM `event` where date>='{$date}' order by date desc LIMIT {$start}, {$recsPerPage}";
$result = $con->query($sql);
$response = array();

if(mysqli_num_rows($result)>0){
  $response['success'] = 1;
  $events = array();
  while($row = $result->fetch_assoc()) {
    array_push($events, $row);
  }
  $response['events'] = $events;
}
else{
  $response['success'] = 0;
  $response['message'] = 'No data';
  $response['sql'] = $sql;
  $response['error_message'] = mysqli_error($con);
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
mysqli_close($con);
?>