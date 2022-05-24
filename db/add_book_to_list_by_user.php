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
    $response = array();
    if(mysqli_query($con, $sql)){
        $response['success']=true;
        $response['type']='add_book';
    }
    else{
        $response['success']=false;
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    mysqli_close($con);
?>