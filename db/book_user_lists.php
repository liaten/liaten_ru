<?php
   require_once('configuration.php');

   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

    $table = $_GET['table'];
    $method = $_GET['method'];
    $id_user = $_GET['id_user'];
    $id_book = $_GET['id_book'];
    
    switch ($method){
        case 'insert':
            $sql = 'INSERT INTO '.$table.' (id_user, id_book) VALUES ('.$id_user.','.$id_book.')';
            break;
        case 'delete':
            $sql = 'DELETE FROM '.$table.' WHERE id_user = '.$id_user.' and id_book = '.$id_book;
            break;
        case 'select':
            $sql = 'SELECT * FROM '.$table.' WHERE id_user = '.$id_user.' and id_book = '.$id_book;
    }

    $response = array();
    if(mysqli_query($con, $sql)){
        $response['success']=true;
        $response['type']=$method;
    }
    else{
        $response['success']=false;
        $response['sql'] = $sql;
        $response['error_message'] = mysqli_error($con);
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    mysqli_close($con);
?>