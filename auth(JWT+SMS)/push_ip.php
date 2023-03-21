<?php 
$ip = $_POST['ip'];
$passAPI = $_POST['pass'];

require 'database.php';

if($passAPI==="800134"){
    $query = $link->query("update actual_sms_ip set ip = '$ip' where id = '1'");
    echo "Succesfull";
}
else{
   echo "error " . $passAPI; 
}