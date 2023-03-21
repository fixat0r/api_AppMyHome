<?php
include 'database.php';

$NAME = $_POST['NAME'];
$SURNAME = $_POST['SURNAME'];
$FIRST = $_POST['FIRST'];
$LAST = $_POST['LAST'];


$query=$link->query("SELECT count(id) as count FROM mrequest where status = 'закрыто ($SURNAME.$NAME)'");

$result = array();
while($rowData = $query->fetch_assoc()){
$result[] = $rowData;
}

$query=$link->query("SELECT * FROM mrequest where status = 'закрыто ($SURNAME.$NAME)' limit $FIRST,$LAST");
while($rowData = $query->fetch_assoc()){
$result[] = $rowData;
}

echo json_encode($result,JSON_UNESCAPED_UNICODE);
$link->close();