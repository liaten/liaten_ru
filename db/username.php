<?php
require_once('configuration.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if (!$conn){
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}

$userid = $_POST['userid'];
// $userid = 'admin';
$result = mysqli_query($conn,"SELECT userid FROM `user` where 
userid='$userid';");
$row = mysqli_fetch_array($result);
$data = $row[0];
if($data){
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

mysqli_close($conn);

?>