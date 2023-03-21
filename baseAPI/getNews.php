<?php
include 'database.php';
/*

    all = true -> UK, code - required attributes
    all = false -> UK, code, first, last - required attributes

*/

if($_GET['all']=="true"){
$query = $link->query("SELECT * FROM UK_news WHERE UK='".$_GET['UK']."' and code = '".$_GET['code']."'");
    
}
else{

    $query = $link->query("SELECT * FROM UK_news WHERE UK='".$_GET['UK']."' and code = '".$_GET['code']."' limit ".$_GET['first'].", ".$_GET['last']."");
}

$result = array();
while($rowData = $query->fetch_assoc()){
$result[] = $rowData;
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
$link->close();
