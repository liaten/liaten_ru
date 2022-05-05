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
    $gender = $_GET['gender'];

    $date=date("Y-m-d",strtotime($date));

    $read_type = $_GET['type'];
    if($read_type=='books_on_hands'){
        //
    }
    switch ($read_type){
        case 'books_on_hands':
            $sql = 'INSERT INTO `books_on_hands` (is_user, id_book, days) VALUES ("'.$userid.'","'.$bookid.'",0)';
            break;
        case 'reserved_books':
            break;
        case 'wishlist_books':
            break;
    }
    // $sql = 'INSERT INTO user (surname, name, patronymic, gender, phone_number, birth_date, email, userid, password) VALUES ("'.$surname.'","'.$name.'","'.$patronymic.'",'.$gender.','.$phone.',"'.$date.'","'.$email.'","'.$userid.'","'.$passw.'")';
    $response = array();
    if(mysqli_query($con, $sql)){
        $response['success']=true;
        $response['type']='create_user';
        // echo "New record created successfully";
    }
    else{
        // echo "Error: " . $sql . "<br>" . mysqli_error($con);
        $response['success']=false;
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    mysqli_close($con);
?>