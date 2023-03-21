<?php
/*
$token = $_POST['token'];

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('vendor/autoload.php');

$secret_Key  = '68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=';
$date   = new DateTimeImmutable();
$expire_at     = $date->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
$domainName = "your.domain.name";
$username   = "username";                                           // Retrieved from filtered POST data
$request_data = [
    'iat'  => $date->getTimestamp(),         // Issued at: time when the token was generated
    'iss'  => $domainName,                       // Issuer
    'nbf'  => $date->getTimestamp(),         // Not before
    'exp'  => $expire_at,                           // Expire
    'userName' => $username,                     // User name
];
$jwt = JWT::encode(
    $request_data,
    $secret_Key,
    'HS512'
);
echo "token: $jwt\n";

$decoded = JWT::decode($token, new Key($secret_Key, 'HS512'));

$decoded_array = (array) $decoded;
echo "\nDecode:\n" . print_r($decoded_array, true) . "\n"; 
if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Token not found in request';
    exit;
}
*/
/*
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('vendor/autoload.php');

$privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC0fNy8qYwGn53B
kJHsLZk1YkSnlG2ZX6eLCuiPeaTCyVEaoVq03IyjlA6tBFqATAjgeUbdeTOu7EHk
jq2HlGz6F3wTiavTY9VqTS2xBQrHlCYO/TePxvnNlI+kFGp/B3fywm9VzxuRqHhr
N5gUR06ovmf4PPqZNiUrhAozM1f29h27xuMzBbOzrwkwUvevGmyLDQuY/LmWiRvY
0gdOyAdnb4+zePqPPhqdrarOOXbRGrIjZHCZeAYL0oKT+4abfkdMuEgIx9Rv3cAo
v7obFypUt92rvuSUCoSdjaXZqHgzIxkxw6GqirXs2+dgzpgM9KNBC4CTRsOB17X+
r9a5mIAVAgMBAAECggEAHNq5ZLqrqti/HRWXvpernrU5yfDDdM8DYgnkaXZGY5L7
vF4qD4VoQTPdBMa6u+LBUzcQSpKjM0aMt5V3ze0UtFwnd0LTOCsFu3DglSRRN4b1
GVWyGZzzOBfqvuM6A1pA+uEgG3/OJdiL0oLuH+UmgM5aoNJe3eT3caAyYUJxawcO
OTJcK6iwKZRn72yGHvMjq4Ghb/Z8aSBGePuajqSJiando+0bIfbvm3xC0mhjC4U/
Jzgj9FaJLQ7dh7LAH5ObL2fjwZCXenE7VR0Qo2OcYGMNieVh0WHA0v0ZupzADOR4
GEnfngo4+us4wQey6L6TQsGCAxj2MK4J4R/qE7ZpIQKBgQDmjF7DilOXSLwBRXMT
3zBNo/DP6Aaozmur7flTfb0qMsEZfmxQzonRE491yb3O/o1Oef8WYijVcarts+m3
m8RJZ2zk3eN5QUrkMLexZRVszIbL0LS0EFtYkSXg1G/l5NGt7RIS9Gt4342nvdI7
0P2jY1rMlgWDY9mNNXPygSlKMwKBgQDIabUjSn2yavfQxEITW1GXJlAbdwn2NRKQ
2xfRV748UCjXvD9QDg9FxDVQWcJ6UBoP5D/gANfA5rZoFSpP0loDjkzwZDBNntIu
PKGps59cFyi3GhrovfotsRtKd82mVYFRSPIhQCTM/MiWhEk2wiapTjq36pzUPjUG
E/1kr4dUlwKBgHl9CMbUEr6K1n95AG49U2/mbxSv+SplNDnyeksz3EXrXvQ3OY7P
d7JUM2nneH0miIINKY27BjeL4X3HK+bUT3g65xgnkSIpdPSQc4wob0TY9kNa5I5q
fChMvIAgkiK8FH4pijew0x1r+HKnRay9sZqy1XsvpxIYwOB3hXUJ+R8fAoGBAIiK
TFiw5ZZq/k+Dhqj9bEcYWTd9EJJncjCytDVyHC+nRUxF+rSl/42+sbv+i1sdu8Pb
9BC/Qj8wcFHVKbCcVatahdy5xZb8f6H0uQePUyFAvgKRjIfI9uuuYDOKD9glJSem
FSDGPMxT5K13jxH5kLGElMi81QBdKW7sq5SvafodAoGBAJ/OqMtHdCi7MRQPAYPf
TDIbO1ymLtYnCe8nHcBA/VyAZjlSez6P+tsAiVrpA1BNw8BRV/9wdyqr6CPv+EDW
iNMrDrMPfAfv6k7L6scE5NOdX6Vb01GITcj4ag8oXsuG1AhZ1+81gIum7DlfGtxB
NzhUdBtn/Oyod4UeDb5uA648
-----END PRIVATE KEY-----
EOD;

$publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtHzcvKmMBp+dwZCR7C2Z
NWJEp5RtmV+niwroj3mkwslRGqFatNyMo5QOrQRagEwI4HlG3XkzruxB5I6th5Rs
+hd8E4mr02PVak0tsQUKx5QmDv03j8b5zZSPpBRqfwd38sJvVc8bkah4azeYFEdO
qL5n+Dz6mTYlK4QKMzNX9vYdu8bjMwWzs68JMFL3rxpsiw0LmPy5lokb2NIHTsgH
Z2+Ps3j6jz4ana2qzjl20RqyI2RwmXgGC9KCk/uGm35HTLhICMfUb93AKL+6Gxcq
VLfdq77klAqEnY2l2ah4MyMZMcOhqoq17NvnYM6YDPSjQQuAk0bDgde1/q/WuZiA
FQIDAQAB
-----END PUBLIC KEY-----
EOD;

$payload = [
    'iss' => 'example.org',
    'aud' => 'example.com',
    'iat' => 1356999524,
    'nbf' => 1357000000
];

$jwt = JWT::encode($payload, $privateKey, 'RS256');
echo "Encode:\n" . print_r($jwt, true) . "\n";

$decoded = JWT::decode($jwt, new Key($publicKey, 'RS256'));

$decoded_array = (array) $decoded;
echo "Decode:\n" . print_r($decoded_array, true) . "\n";
*/
$token = $_POST['token'];

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('vendor/autoload.php');

$secret_Key  = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC0fNy8qYwGn53B
kJHsLZk1YkSnlG2ZX6eLCuiPeaTCyVEaoVq03IyjlA6tBFqATAjgeUbdeTOu7EHk
jq2HlGz6F3wTiavTY9VqTS2xBQrHlCYO/TePxvnNlI+kFGp/B3fywm9VzxuRqHhr
N5gUR06ovmf4PPqZNiUrhAozM1f29h27xuMzBbOzrwkwUvevGmyLDQuY/LmWiRvY
0gdOyAdnb4+zePqPPhqdrarOOXbRGrIjZHCZeAYL0oKT+4abfkdMuEgIx9Rv3cAo
v7obFypUt92rvuSUCoSdjaXZqHgzIxkxw6GqirXs2+dgzpgM9KNBC4CTRsOB17X+
r9a5mIAVAgMBAAECggEAHNq5ZLqrqti/HRWXvpernrU5yfDDdM8DYgnkaXZGY5L7
vF4qD4VoQTPdBMa6u+LBUzcQSpKjM0aMt5V3ze0UtFwnd0LTOCsFu3DglSRRN4b1
GVWyGZzzOBfqvuM6A1pA+uEgG3/OJdiL0oLuH+UmgM5aoNJe3eT3caAyYUJxawcO
OTJcK6iwKZRn72yGHvMjq4Ghb/Z8aSBGePuajqSJiando+0bIfbvm3xC0mhjC4U/
Jzgj9FaJLQ7dh7LAH5ObL2fjwZCXenE7VR0Qo2OcYGMNieVh0WHA0v0ZupzADOR4
GEnfngo4+us4wQey6L6TQsGCAxj2MK4J4R/qE7ZpIQKBgQDmjF7DilOXSLwBRXMT
3zBNo/DP6Aaozmur7flTfb0qMsEZfmxQzonRE491yb3O/o1Oef8WYijVcarts+m3
m8RJZ2zk3eN5QUrkMLexZRVszIbL0LS0EFtYkSXg1G/l5NGt7RIS9Gt4342nvdI7
0P2jY1rMlgWDY9mNNXPygSlKMwKBgQDIabUjSn2yavfQxEITW1GXJlAbdwn2NRKQ
2xfRV748UCjXvD9QDg9FxDVQWcJ6UBoP5D/gANfA5rZoFSpP0loDjkzwZDBNntIu
PKGps59cFyi3GhrovfotsRtKd82mVYFRSPIhQCTM/MiWhEk2wiapTjq36pzUPjUG
E/1kr4dUlwKBgHl9CMbUEr6K1n95AG49U2/mbxSv+SplNDnyeksz3EXrXvQ3OY7P
d7JUM2nneH0miIINKY27BjeL4X3HK+bUT3g65xgnkSIpdPSQc4wob0TY9kNa5I5q
fChMvIAgkiK8FH4pijew0x1r+HKnRay9sZqy1XsvpxIYwOB3hXUJ+R8fAoGBAIiK
TFiw5ZZq/k+Dhqj9bEcYWTd9EJJncjCytDVyHC+nRUxF+rSl/42+sbv+i1sdu8Pb
9BC/Qj8wcFHVKbCcVatahdy5xZb8f6H0uQePUyFAvgKRjIfI9uuuYDOKD9glJSem
FSDGPMxT5K13jxH5kLGElMi81QBdKW7sq5SvafodAoGBAJ/OqMtHdCi7MRQPAYPf
TDIbO1ymLtYnCe8nHcBA/VyAZjlSez6P+tsAiVrpA1BNw8BRV/9wdyqr6CPv+EDW
iNMrDrMPfAfv6k7L6scE5NOdX6Vb01GITcj4ag8oXsuG1AhZ1+81gIum7DlfGtxB
NzhUdBtn/Oyod4UeDb5uA648
-----END PRIVATE KEY-----
EOD;
$public_Key = <<<EOD
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtHzcvKmMBp+dwZCR7C2Z
NWJEp5RtmV+niwroj3mkwslRGqFatNyMo5QOrQRagEwI4HlG3XkzruxB5I6th5Rs
+hd8E4mr02PVak0tsQUKx5QmDv03j8b5zZSPpBRqfwd38sJvVc8bkah4azeYFEdO
qL5n+Dz6mTYlK4QKMzNX9vYdu8bjMwWzs68JMFL3rxpsiw0LmPy5lokb2NIHTsgH
Z2+Ps3j6jz4ana2qzjl20RqyI2RwmXgGC9KCk/uGm35HTLhICMfUb93AKL+6Gxcq
VLfdq77klAqEnY2l2ah4MyMZMcOhqoq17NvnYM6YDPSjQQuAk0bDgde1/q/WuZiA
FQIDAQAB
-----END PUBLIC KEY-----
EOD;
echo "pass = " . generationRT()."\n";
echo "pass = " . generationRT()."\n";
$date   = new DateTimeImmutable();
$expire_at     = $date->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
$domainName = "your.domain.name";
$username   = "username";                                           // Retrieved from filtered POST data
$request_data = [
    'iat'  => $date->getTimestamp(),         // Issued at: time when the token was generated
    'iss'  => $domainName,                       // Issuer
    'nbf'  => $date->getTimestamp(),         // Not before
    'exp'  => $expire_at,                           // Expire
    'userName' => $username,
    'name' => "nikita",                     // User name
];
$jwt = JWT::encode(
    $request_data,
    $secret_Key,
    'RS256'
);
echo "token: $jwt\n";

try {
    $decoded = JWT::decode($token, new Key($public_Key, 'RS256'));
} catch (InvalidArgumentException $e) {
    echo 1;
    // provided key/key-array is empty or malformed.
} catch (DomainException $e) {
    
    echo 2;
    // provided algorithm is unsupported OR
    // provided key is invalid OR
    // unknown error thrown in openSSL or libsodium OR
    // libsodium is required but not available.
} catch (SignatureInvalidException $e) {
    echo 3;
    // provided JWT signature verification failed.
} catch (BeforeValidException $e) {
    echo 4;
    // provided JWT is trying to be used before "nbf" claim OR
    // provided JWT is trying to be used before "iat" claim.
} catch (ExpiredException $e) {
    echo 5;
    // provided JWT is trying to be used after "exp" claim.
} catch (UnexpectedValueException $e) {
    echo $e;
    // provided JWT is malformed OR
    // provided JWT is missing an algorithm / using an unsupported algorithm OR
    // provided JWT algorithm does not match provided key OR
    // provided key ID in key/key-array is empty or invalid.
}


$decoded_array = (array) $decoded;
echo "\nDecode:\n" . print_r($decoded_array, true) . "\n"; 
 $tks = \explode('.', $jwt);
function generationRT(){
    $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shfl = str_shuffle($comb);
    $pwd = substr($shfl,0,64);
    return $pwd;
}
  
 /*
if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Token not found in request';
    exit;
}
*/