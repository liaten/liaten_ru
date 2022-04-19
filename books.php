<?php
$servername = "localhost";
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
  $sql = "SELECT title, author, theme, date FROM `book`;";
  $result = $conn->query($sql);
  $rows = array();
  while($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }
  echo json_encode($rows, JSON_UNESCAPED_UNICODE);
$conn->close();
?>