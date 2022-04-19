<?php
$servername = "server21.hosting.reg.ru";
$username = "u1610989_admin";
$password = "vF5zW5tT8zxJ1t";
$dbname = "u1610989_library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if (!$conn) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
  }

$sql = "SELECT title, author, theme, date FROM `book` order by date desc limit 7;";
$result = $conn->query($sql);
$response = array();

if(mysqli_num_rows($result)>0){
  $response['success'] = 1;
  $books = array();
  
  while($row = $result->fetch_assoc()) {
    array_push($books, $row);
    //$books[] = $row;
  }
  $response['books'] = $books;
}
else{
  $response['success'] = 0;
  $response['message'] = 'No data';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);

?>