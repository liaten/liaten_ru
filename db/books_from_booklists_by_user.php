<?php
  require_once('configuration.php');
  $con = new mysqli($servername, $username, $password, $dbname);
  $con->set_charset("utf8");

  if (!$con){
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
  }
  $table = $_GET['table'];
  $id_user = $_GET['id_user'];
  $limited = $_GET['limited'];

  $sql = "SELECT id,title,author,cover,date,theme,description 
  FROM book left join {$table} on book.id={$table}.id_book
  where id in (select id_book from {$table} where id_user = {$id_user})
  order by datetime_added desc";
  switch($limited){
    case 'y':
      $sql .= ' limit 8';
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