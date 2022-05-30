<?php
require_once('configuration.php');
$con = new mysqli($servername, $username, $password, $dbname);
$con->set_charset("utf8");
if (!$con){
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}
$limited = $_GET['limited'];
$page = $_GET['page'];
$recsPerPage = $_GET['recsPerPage'];

$sql = "SELECT * FROM `book` order by date desc";

switch($limited){
  case 'y':
    $sql = 'SELECT * FROM `book` order by date desc limit 7';
    break;
  case 'n':
    $sql = "set @row_number = 0;\nset @recsPerPage = ".$recsPerPage.";\nset @page = ".$page.";\n"
    ."SELECT author, title, cover, theme, description, date FROM book where (@row_number:=@row_number+1) BETWEEN 1+(@recsPerPage)*(@page-1) AND @recsPerPage*(@page) order by date asc";
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
  $response['sql'] = $sql;
  $response['error_message'] = mysqli_error($con);
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
mysqli_close($con);
?>