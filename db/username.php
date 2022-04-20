<?php
$servername = "server21.hosting.reg.ru";
$username = "u1610989_admin";
$password = "vF5zW5tT8zxJ1t";
$dbname = "u1610989_library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if (!$conn){
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}

$username = $_POST['username'];

$sql = "SELECT userid FROM `user` WHERE userid='$username';";
$result = $conn->query($sql);
$response = array();

// if(mysqli_num_rows($result)>0){
//   $response['success'] = 1;
//   $data = array();
  
//   while($row = $result->fetch_assoc()) {
//     array_push($data, $row);
//   }
//   $response['user'] = $data;
// }
// else{
//   $response['success'] = 0;
//   $response['message'] = 'No data';
// }
$row = mysqli_fetch_array($result);
$data = $row[0];

if($data){
   echo $data;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);

?>