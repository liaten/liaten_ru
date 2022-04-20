<?php
require_once('configuration.php');
$opts = array('http' =>
  array(
    'method'  => 'POST',
    'header'  => "Content-Type: text/xml\r\n".
      "Authorization: Basic ".base64_encode("$username:$password")."\r\n",
    'timeout' => 60
  )
);
                       
$context  = stream_context_create($opts);
$url = 'https://'.$servername;
$result = file_get_contents($url, false, $context, -1, 40000);
if(mysqli_num_rows($result)>0){
  $response['success'] = 1;
  $books = array();
  
  while($row = $result->fetch_assoc()) {
    array_push($books, $row);
  }
  $response['books'] = $books;
}
else{
  $response['success'] = 0;
  $response['message'] = 'No data';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);

?>