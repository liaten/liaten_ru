<?php
$servername = "localhost";
$username = "u1610989_admin";
$password = "vF5zW5tT8zxJ1t";
$dbname = "u1610989_library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
  }
$conn->close();
?>