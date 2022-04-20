<?php
$q=$_GET["q"];
// Load Joomla! configuration file
require_once('configuration.php');
// Create a JConfig object
$config = new JConfig();
// Get the required codes from the configuration file
$server = $config->host;
$username   = $config->user;
$password   = $config->password;
$database = $config->db;

$con = mysqli_connect($server,$username,$password,$database);
if (!$con){
die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,$database);

$q = mysqli_real_escape_string($con,$q);

// Save form input
$a10001 = $_POST['a10001'];
mysqli_query($con,"INSERT INTO cypg8_testtest (a10001) VALUES ('".$a10001."')");

// Close connection
mysqli_close($con);
?>
