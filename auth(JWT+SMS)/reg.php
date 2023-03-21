<?php
require 'database.php';
require 'keys.php';
require_once('vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$name = $_POST['name'];
$surname = $_POST['surname'];
$middle_name = $_POST['middle_name'];
$pass = $_POST['pass'];
if($name === "" || $name === null || $surname === "" || $surname=== null 
    || $middle_name === "" || $middle_name === null || $pass === "" || $pass === null){
        //echo"data error\n";
        $final_data = [
            'JWT'  => "no",         // Issued at: time when the token was generated
            'RT'  => "no",                       // Issuer
            'answer' => "data error",                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        exit;
}
else{
    $query = $link->query("SELECT count(id) FROM test_api WHERE name = '$name' and pass = '$pass'");
    $result = array();
    while($rowData = $query->fetch_assoc()){
    $result[] = $rowData;
    }
    $resCount = 0;
    foreach($query as $row){
        $resCount = $row["count(id)"];
    }
    if($resCount==="0"){
        echo "data: $surname $name $middle_name $pass\n";
        $RT = generationRT();
        $query = $link->query("insert into test_api(name,surname,middle_name,pass,refresh) value('$name','$surname','$middle_name','$pass','$RT')");
        echo"insert: OK\n";
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+60 minutes')->getTimestamp();      // Add 60 seconds
        $domainName = "MyHome";
        $request_data = [
            'iat'  => $date->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $domainName,                       // Issuer
            'nbf'  => $date->getTimestamp(),         // Not before
            'exp'  => $expire_at,                           // Expire
            'surname' => $surname,
            'name' => $name,
            'middle_name' => $middle_name,  
        ];
        $jwt = JWT::encode(
            $request_data,
            $secret_Key,
            'RS256'
        );
        echo "JWT: $jwt\n";
        echo "RT: $RT\n";

        $final_data = [
            'JWT'  => $jwt,         // Issued at: time when the token was generated
            'RT'  => $RT,                       // Issuer
            'answer' => "successful register",                     // User name
        ];

        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
    }
    else{
        $final_data = [
            'JWT'  => "no",         // Issued at: time when the token was generated
            'RT'  => "no",                       // Issuer
            'answer' => "User is registered, please log in",                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
    }
}

function generationRT(){
    $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shfl = str_shuffle($comb);
    $pwd = substr($shfl,0,64);
    return $pwd;
}
