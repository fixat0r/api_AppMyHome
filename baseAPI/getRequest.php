<?php
include 'database.php';

$UK = $_POST['UK'];
$TYPE = $_POST['TYPE'];
$FIRST = $_POST['FIRST'];
$LAST = $_POST['LAST'];
$ALL = $_POST['ALL'];


if($ALL=="true"){
    $query = $link->query("SELECT id, data, type, message, address, phone, user_id, status  FROM mrequest where uk='$UK' order by id desc limit $FIRST, $LAST");

    $result = array();
    
    while($rowData = $query->fetch_assoc()){
    $result[] = $rowData;
    }
    
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
    $link->close();
}
else{
$query = $link->query("SELECT id, message, address, phone, user_id, status  FROM mrequest where uk='$UK' and type = '$TYPE' order by id desc limit $FIRST, $LAST");

$result = array();

while($rowData = $query->fetch_assoc()){
$result[] = $rowData;
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);
$link->close();
}

