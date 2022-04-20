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
mysqli_query($conn,"SELECT * FROM `user` where user like '$user'");

// Close connection
mysqli_close($conn);
?>
