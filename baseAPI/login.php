<?php

require 'database.php';


$login = $_POST['login'];
$pass = $_POST['pass'];

$query = $link->query("SELECT count(id) FROM final_user WHERE user_email = '$login' and password = '$pass'");
$result = array();

while($rowData = $query->fetch_assoc()){
$result[] = $rowData;
}

$resCount = 0;
foreach($query as $row){
    $resCount = $row["count(id)"];
}

if($resCount!="0"){
    $finalquery = $link->query("SELECT * FROM final_user WHERE user_email = '$login' and password = '$pass'");
    $finalresult = array();
    
    while($rowData = $finalquery->fetch_assoc()){
    $finalresult[] = $rowData;
    }
    echo json_encode($finalresult,JSON_UNESCAPED_UNICODE);
}
else{
echo "not found";
}
