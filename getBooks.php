<?php
$servername = "localhost";
$username = "u1610989_admin";
$password = "DFSWG*&$@#^$^&sadasdg212";
$dbname = "u1610989_library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `book` LIMIT 10";
$result = mysqli_query($conn, $sql) or die("<p color=\"#f00\">Could not query database.</p>");
while($row = mysqli_fetch_assoc($result) ) {
   echo $row['title'];
}

$conn->close();
?>