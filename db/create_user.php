<?php
   require_once('configuration.php');

   // Create connection
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
	
   $surname = $_POST['surname'];
   $name = $_POST['name'];
   $patronymic = $_POST['patronymic'];
   $phone = $_POST['phone'];
   $date = $_POST['date'];
   $email = $_POST['email'];
   $userid = $_POST['userid'];
   $passw = $_POST['password'];

   $stmt = $con->prepare('INSERT INTO `user` (surname, name, patronymic, phone_number, birth_date, email, userid, password) VALUES (?,?,?,?,?,?,?,?)');
   $stmt->bind_param('ssssss',
   $_POST[surname], $_POST[name],
   $_POST[patronymic], $_POST[phone],
   $_POST[date], $_POST[email],
   $_POST[userid], $_POST[password]
);
    $stmt->execute();

   $result = mysqli_query(
       $con,
       'SELECT * FROM user'
   );
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
	
   mysqli_close($con);
?>