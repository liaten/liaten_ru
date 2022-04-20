<?php
$q=$_GET["q"];
// Load configuration file
require_once('configuration.php');

$conn = new mysqli($servername, $username, $password, $dbname);
if (!$con){
die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,$database);

$q = mysqli_real_escape_string($con,$q);

// Save form input
$user = $_POST['user'];
mysqli_query($con,"SELECT * FROM `user` where user like '$user'");

// Close connection
mysqli_close($con);
?>
