<?php
   require_once('configuration.php');

   // Create connection
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

    $userid = $_GET['userid'];
    $bookid = $_GET['bookid'];
    $table = $_GET['table'];
    
    $sql = 'INSERT INTO ';
    switch ($table){
        case 'books_on_hands':
            $sql .= 'books_on_hands';
            break;
        case 'reserved_books':
            $sql .= 'reserved_books';
            break;
        case 'wishlist_books':
            $sql .= 'wishlist_books';
            break;
    }
    $sql .= ' (id_user, id_book';
    switch ($table){
        case 'books_on_hands':
            $sql .= ', days)';
            break;
        case 'reserved_books':
            $sql .= ')';
            break;
        case 'wishlist_books':
            $sql .= ')';
            break;
    }
    $sql .= ' VALUES ('.$userid.','.$bookid;
    switch ($table){
        case 'books_on_hands':
            $sql .= ',0)';
            break;
        case 'reserved_books':
            $sql .= ')';
            break;
        case 'wishlist_books':
            $sql .= ')';
            break;
    }
    echo $sql;
    // $sql = 'INSERT INTO user (surname, name, patronymic, gender, phone_number, birth_date, email, userid, password) VALUES ("'.$surname.'","'.$name.'","'.$patronymic.'",'.$gender.','.$phone.',"'.$date.'","'.$email.'","'.$userid.'","'.$passw.'")';
    $response = array();
    if(mysqli_query($con, $sql)){
        $response['success']=true;
        $response['type']='add_book';
        // echo "New record created successfully";
    }
    else{
        // echo "Error: " . $sql . "<br>" . mysqli_error($con);
        $response['success']=false;
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    mysqli_close($con);
?>