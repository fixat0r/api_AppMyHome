<?php

$hostname = 'localhost';
$username = 'user';
$pass = 'password';
$dbname = 'data';

$link = new mysqli($hostname,$username,$pass,$dbname);

if($link->connect_error){
die("faild database connect" . $link->connect_error);
}
?>