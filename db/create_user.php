<?php
   require_once('configuration.php');

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
    $gender = $_GET['gender'];

    $date=date("Y-m-d",strtotime($date));

    $sql = 'INSERT INTO user (surname, name, patronymic, gender, phone_number, birth_date, email, userid, password) VALUES ("'.$surname.'","'.$name.'","'.$patronymic.'","'.$gender.'",'.$phone.',"'.$date.'","'.$email.'","'.$userid.'","'.$passw.'")';
    $response = array();
    if(mysqli_query($con, $sql)){
        $response['success']=true;
        $response['type']='create_user';
    }
    else{
        $response['success']=false;
        $response['sql'] = $sql;
        $response['error_message'] = mysqli_error($con);
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    mysqli_close($con);
?>