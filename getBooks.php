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

$sql = "SELECT * FROM book";
// $result = $conn->query($sql);
$result = mysqli_query($conn,$sql)

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // print_r($row);
    echo "row!"
  }
} else {
  echo "0 results";
}
$conn->close();
?>