<?php

require 'database.php';
require 'keys.php';
require_once('vendor/autoload.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$login = $_POST['login'];
$pass = $_POST['pass'];
if($login===""||$login===null||$pass===""||$pass===null){
    $final_data = [
        'JWT'  => "no",         // Issued at: time when the token was generated
        'RT'  => "no",                       // Issuer
        'answer' => "data error",                     // User name
    ];
    echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
    exit;
}
else{
    $query = $link->query("SELECT count(id) FROM musers WHERE phone = '$login' and password = '$pass'");
    $result = array();

    while($rowData = $query->fetch_assoc()){
    $result[] = $rowData;
    }
    $resCount = 0;
    foreach($query as $row){
        $resCount = $row["count(id)"];
    }

if($resCount!="0"){

    $finalquery = $link->query("SELECT id,status,surname,name,middle_name,phone,uk,personal_check,sity,address,email,refresh FROM musers WHERE phone = '$login' and password = '$pass'");
    $finalresult = array();
    while($rowData = $finalquery->fetch_assoc()){
    $finalresult[] = $rowData;
    }
    
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+60 minutes')->getTimestamp();      // Add 60 seconds
        $domainName = "MyHome";
        $request_data = [
            'id' => $finalresult[0]['id'],
            'status'=> $finalresult[0]['status'],
            'surname'=> $finalresult[0]['surname'],
            'name'=> $finalresult[0]['name'],
            'middle_name'=> $finalresult[0]['middle_name'],
            'phone'=> $finalresult[0]['phone'],
            'uk'=> $finalresult[0]['uk'],
            'personal_check'=> $finalresult[0]['personal_check'],
           'sity'=> $finalresult[0]['sity'],
            'address'=> $finalresult[0]['address'],
            'email'=> $finalresult[0]['email'],
            'refresh'=> $finalresult[0]['refresh'],
            'iat'  => $date->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $domainName,                       // Issuer
            'nbf'  => $date->getTimestamp(),         // Not before
            'exp'  => $expire_at,                           // Expire
        ];
        $jwt = JWT::encode(
            $request_data,
            $secret_Key,
            'RS256'
        );
        $fdata=[
            'JWT'=> $jwt,
            'RT' => $finalresult[0]['refresh'],
            'answer' => "successfull login"
        ];
    echo json_encode($fdata,JSON_UNESCAPED_UNICODE);
}
else{
    $final_data = [
        'JWT'  => "no",         // Issued at: time when the token was generated
        'RT'  => "no",                       // Issuer
        'answer' => "user not register",                     // User name
    ];
    echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
    exit;
}
}

