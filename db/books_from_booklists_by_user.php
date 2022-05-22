<?php
require_once('configuration.php');

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
$con->set_charset("utf8");

if (!$con){
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}
$table = $_GET['table'];
$id_user = $_GET['id_user'];

$sql = 'SELECT * FROM book where id = (select id_book from '.$table.' where id_user = '.$id_user.') order by date desc limit 7';
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