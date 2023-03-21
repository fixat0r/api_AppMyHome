<?php
include 'database.php';

$NAME = $_POST['NAME'];
$SURNAME = $_POST['SURNAME'];
$ID = $_POST['ID'];

$query = $link->query("UPDATE mrequest SET status = 'закрыто ($SURNAME.$NAME)' where id = '$ID' ");

echo json_encode("succesfull",JSON_UNESCAPED_UNICODE);
$link->close();