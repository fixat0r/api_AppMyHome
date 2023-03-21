<?php
$number =$_POST['number'];
$message =$_POST['message'];
$passr = $_POST['pass'];

require 'database.php';

echo "1";
$query = $link->query("SELECT ip FROM actual_sms_ip WHERE id = 1");
    $result = array();

    while($rowData = $query->fetch_assoc()){
    $result[] = $rowData;
    }
    $resCount = "0";
    foreach($query as $row){
        $resCount = $row["ip"];
    }

    

$url = 'http://'.$resCount.':8081/testPHP.php';
echo "$url ";
$params = array(
    'number' => $number, // в http://localhost/post.php это будет $_POST['param1'] == '123'
    'pass' => $passr, // в http://localhost/post.php это будет $_POST['param2'] == 'abc'
    'message' => $message,
);
$result = file_get_contents($url, false, stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($params)
    )
)));

echo $result;
echo "Ответ на Ваш запрос: ".$response;
