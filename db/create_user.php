<?php
   require_once('configuration.php');

   // Create connection
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   $types = 'ssssssss';
   $data = [
       $_POST['surname'], $_POST['name'],
       $_POST['patronymic'], $_POST['phone'],
       $_POST['date'], $_POST['email'],
       $_POST['userid'], $_POST['password']
    ];
    $stmt = $con->prepare('INSERT INTO `user` (surname, name, patronymic, phone_number, birth_date, email, userid, password) VALUES (?,?,?,?,?,?,?,?)');
    $stmt->bind_param($types, ...$data);
    if($stmt->execute()){
        echo "Inserted successfully";
    }
    if($stmt ->errno){
        printf("Could not insert record into table: %s<br />", $stmt->error);
    }
    mysqli_close($con);
?>