<?php
include 'database.php';

$query = $link->query("SELECT distinct sity FROM UK");
$result = array();
while($rowData = $query->fetch_assoc()){
$result[] = $rowData;
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);

