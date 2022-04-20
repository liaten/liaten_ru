<?php
// Load configuration file
require_once('configuration.php');

$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn){
die('Could not connect: ' . mysqli_error($conn));
}

mysqli_select_db($conn,$database);

$q = mysqli_real_escape_string($conn,$q);

// Save form input
$user = $_POST['user'];
$sql = "SELECT * FROM `user` where userid like '$user';";
$result = $conn->query($sql);
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
mysqli_close($conn);
?>
