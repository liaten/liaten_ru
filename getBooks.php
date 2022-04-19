<?php 

 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'u1610989_admin');
 define('DB_PASS', 'A^sadg8*(DHA');
 define('DB_NAME', 'u1610989_library');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT id, title, author, cover, theme, date FROM book;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($id, $title, $author, $cover, $theme, $date);
 
 $books = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['id'] = $id; 
 $temp['title'] = $title; 
 $temp['author'] = $author; 
 $temp['cover'] = $cover; 
 $temp['theme'] = $theme; 
 $temp['date'] = $date;
 array_push($books, $temp);
 }
 
 //displaying the result in json format
 echo mysqli_connect_error();
 echo json_encode($books);
 ?>