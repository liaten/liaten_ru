<?php
   require_once('configuration.php');

   $con = new mysqli($servername, $username, $password, $dbname);
   $con->set_charset("utf8");

   if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

    $table = $_GET['table'];
    $id_user = $_GET['id_user'];

    $date=date("Y-m-d",time());
    $sql = 'SELECT * FROM '.$table.' WHERE id_user = '.$id_user;

    $response = array();
    $result = mysqli_query($con, $sql);
    if($result){
        $response['success']=true;
        if(mysqli_num_rows($result)>0){
            $info = array();
            while($row = $result->fetch_assoc()) {
                array_push($info, $row);
            }
            $response[$method] = $info;
            }
            else{
            $response[$method] = 'No entries';
            }
        $response['table'] = $table;
    }
    else{
        $response['success']=false;
        $response['sql'] = $sql;
        $response['error_message'] = mysqli_error($con);
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    mysqli_close($con);
?>