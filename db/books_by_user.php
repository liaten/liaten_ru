<?php
require_once('configuration.php');

$con = new mysqli($servername, $username, $password, $dbname);
$con->set_charset("utf8");

if (!$con){
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}

$userid = $_GET['userid'];
$table = $_GET['table'];
$limited = $_GET['limited'];

$sql = "SELECT * FROM `book` order by date desc";
switch($limited){
  case 'y':
    $sql .= ' limit 7';
    break;
  case 'n':
    break;
  default:
    break;
  }

$result = $con->query($sql);
$response = array();

if(mysqli_num_rows($result)>0){
  $response['success'] = 1;
  $books = array();
  
  while($row = $result->fetch_assoc()) {
    array_push($books, $row);
  }
  $response['books'] = $books;
}
else{
  $response['success'] = 0;
  $response['message'] = 'No data';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
mysqli_close($con);

?>