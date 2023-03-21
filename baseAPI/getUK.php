<?php
include 'database.php';

$query = $link->query("SELECT name FROM UK WHERE sity='".$_GET['sity']."'");
$result = array();
while($rowData = $query->fetch_assoc()){
$result[] = $rowData;
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
