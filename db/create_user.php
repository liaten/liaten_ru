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
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $userid = $_POST['userid'];
    $passw = $_POST['password'];

    $sql = 'INSERT INTO user (id, surname, name, patronymic, phone_number, birth_date, email, userid, password) VALUES ((select max(id) from user),"'.$surname.'","'.$name.'","'.$patronymic.'","'.$phone.'","'.$date.'","'.$email.'","'.$userid.'","'.$passw.'")';
    if(mysqli_query($con, $sql)){
        echo "New record created successfully";
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($con);
?>