<?php
require_once('configuration.php');
$con = new mysqli($servername, $username, $password, $dbname);
$con->set_charset("utf8");
if (!$con){
  echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
  exit;
}
$first_clause = false;
$theme = $_GET['theme'];
$author = $_GET['author'];
$bookName = $_GET['bookName'];
$limited = $_GET['limited'];
$sql = "SELECT * FROM `book` ";
if($theme!=''){
    $sql .= "where theme like '%{$theme}%'";
}
if($author!=''){
    if($first_clause){
        $sql .= " and author like '%{$author}%'";
    }
    else{
        $sql .= "where author like '%{$author}%'";
    }
}
if($bookName!=''){
    if($first_clause){
        $sql .= " and title like '%{$bookName}%'";
    }
    else{
        $sql .= "where title like '%{$bookName}%'";
    }
}
$sql .= "order by date desc";
switch($limited){
  case 'y':
    $sql .= " LIMIT 8";
    break;
  case 'n':
    $page = $_GET['page'];
    $recsPerPage = $_GET['recsPerPage'];
    $start = ($page != 1) ? $page * $recsPerPage - $recsPerPage : 0;
    $sql .= " LIMIT {$start}, {$recsPerPage}";
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