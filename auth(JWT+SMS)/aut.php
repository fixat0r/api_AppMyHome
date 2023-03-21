<?php
require 'database.php';
require 'keys.php';
require_once('vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$jwt_data = $_POST['jwt'];
$rt_data = $_POST['rt'];


if($jwt_data===""||$jwt_data===null||$rt_data===""||$rt_data===null){
    $final_data = [
        'JWT'  => "no",         // Issued at: time when the token was generated
        'RT'  => "no",                       // Issuer
        'answer' => "tokens not found",                     // User name
    ];
    echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
    exit;
}
else{
    try {
        
        $decoded_data = JWT::decode($jwt_data, new Key($public_Key, 'RS256'));
        $decoded_array = (array) $decoded_data;
        echo "\nDecode:\n" . print_r($decoded_array, true) . "\n";
        
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+60 minutes')->getTimestamp();      // Add 60 seconds
        $new_data = [
            'iat'  => $date->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $decoded_array['iss'],                       // Issuer
            'nbf'  => $date->getTimestamp(),         // Not before
            'exp'  => $expire_at,                           // Expire
            'surname' => $decoded_array['surname'],
            'name' => $decoded_array['name'],
            'middle_name' => $decoded_array['middle_name'],                     // User name
        ];
        $jwt = JWT::encode(
            $new_data,
            $secret_Key,
            'RS256'
        );
        $final_data = [
            'JWT'  => $jwt,         // Issued at: time when the token was generated
            'RT'  => $rt_data,                       // Issuer
            'answer' => "successfull login",                     // User name
        ];

        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        
    } catch (InvalidArgumentException $e) {
        $final_data = [
            'JWT'  => $jwt,         // Issued at: time when the token was generated
            'RT'  => $rt_data,                       // Issuer
            'answer' => "1 exception",                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        // provided key/key-array is empty or malformed.
    } catch (DomainException $e) {
        $final_data = [
            'JWT'  => $jwt,         // Issued at: time when the token was generated
            'RT'  => $rt_data,                       // Issuer
            'answer' => "2 exception",                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        // provided algorithm is unsupported OR
        // provided key is invalid OR
        // unknown error thrown in openSSL or libsodium OR
        // libsodium is required but not available.
    } catch (SignatureInvalidException $e) {
        $final_data = [
            'JWT'  => $jwt,         // Issued at: time when the token was generated
            'RT'  => $rt_data,                       // Issuer
            'answer' => "3 exception",                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        // provided JWT signature verification failed.
    } catch (BeforeValidException $e) {
        $final_data = [
            'JWT'  => $jwt,         // Issued at: time when the token was generated
            'RT'  => $rt_data,                       // Issuer
            'answer' => "4 exception",                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        // provided JWT is trying to be used before "nbf" claim OR
        // provided JWT is trying to be used before "iat" claim.
    } catch (ExpiredException $e) {
        $final_data = [
            'JWT'  => $jwt,         // Issued at: time when the token was generated
            'RT'  => $rt_data,                       // Issuer
            'answer' => "5 exception",                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        // provided JWT is trying to be used after "exp" claim.
    } catch (UnexpectedValueException $e) {
        $tks = \explode('.', $jwt_data);
        $nameInQuery = base64_decode($tks[1]);

        $dataFromJson = json_decode($nameInQuery);

        $nameInQuery = $dataFromJson->{'name'};
       // echo "\nname: $nameInQuery |\n";
        
        $queryy = $link->query("SELECT refresh FROM test_api WHERE name = '$nameInQuery'");
        $resultt = array();
        while($rowData = $queryy->fetch_assoc()){
        $resultt[] = $rowData;
        }
        if($resultt[0]['refresh']===$rt_data){
            
            function generationRT(){
                $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $shfl = str_shuffle($comb);
                $pwd = substr($shfl,0,64);
                return $pwd;
            }
            $nev_RT = generationRT();
            
        $query = $link->query("update test_api set refresh = '$nev_RT' where name = '$nameInQuery'");
        
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+60 minutes')->getTimestamp();      // Add 60 seconds
        $news_data = [
            'iat'  => $date->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $dataFromJson->{'iss'},                       // Issuer
            'nbf'  => $date->getTimestamp(),         // Not before
            'exp'  => $expire_at,                           // Expire
            'surname' => $dataFromJson->{'surname'},
            'name' => $dataFromJson->{'name'},
            'middle_name' => $dataFromJson->{'middle_name'},  
        ];
        $jwt = JWT::encode(
            $news_data,
            $secret_Key,
            'RS256'
        );
        $final_data = [
            'JWT'  => $jwt,         // Issued at: time when the token was generated
            'RT'  => $nev_RT,                       // Issuer
            'answer' => "generatoin new JWT and RT, log successfull",                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        exit;
            
        }
        else{
            $final_data = [
                'JWT'  => $jwt_data,         // Issued at: time when the token was generated
                'RT'  => $rt_data,                       // Issuer
                'answer' => "bad tokens, log in",                     // User name
            ];
            echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
            exit;
        }

        $final_data = [
            'JWT'  => $jwt_data,         // Issued at: time when the token was generated
            'RT'  => $rt_data,                       // Issuer
            'answer' => "time exception, RT=". $resultt['refresh'],                     // User name
        ];
        echo json_encode($final_data,JSON_UNESCAPED_UNICODE);
        //timeout

        // provided JWT is malformed OR
        // provided JWT is missing an algorithm / using an unsupported algorithm OR
        // provided JWT algorithm does not match provided key OR
        // provided key ID in key/key-array is empty or invalid.
    }
    
}