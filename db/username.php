<?php
require_once('configuration.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if (!$conn){
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}

$sql = "SELECT * FROM `user` limit 1;";
$result = $conn->query($sql);
$response = array();

if(mysqli_num_rows($result)>0){
  $response['success'] = 1;
  $users = array();
  
  while($row = $result->fetch_assoc()) {
    array_push($users, $row);
  }
  $response['users'] = $users;
}
else{
  $response['success'] = 0;
  $response['message'] = 'No data';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);

?>