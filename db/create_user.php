<?php
   require_once('configuration.php');

   // Create connection
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

    $surname = $_GET['surname'];
    $name = $_GET['name'];
    $patronymic = $_GET['patronymic'];
    $date = $_GET['date'];
    $phone = $_GET['phone'];
    $email = $_GET['email'];
    $userid = $_GET['userid'];
    $passw = $_GET['password'];

    $sql = 'INSERT INTO user (id, surname, name, patronymic, phone_number, birth_date, email, userid, password) VALUES ((select max(id) from user),"'.$surname.'","'.$name.'","'.$patronymic.'",'.$phone.','.$date.',"'.$email.'","'.$userid.'","'.$passw.'")';
    if(mysqli_query($con, $sql)){
        echo "New record created successfully";
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($con);
?>