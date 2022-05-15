<?php
   require_once('configuration.php');

   // Create connection
   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

    $id_user = $_GET['id_user'];
    $id_book = $_GET['id_book'];

    $table = $_GET['table'];

    $date=date("Y-m-d",strtotime($date));

    $sql = 'INSERT INTO '.$table.' (id_user, id_book) VALUES ('.$id_user.','.$id_book.')';
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