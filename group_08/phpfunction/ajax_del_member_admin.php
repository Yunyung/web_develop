<?php
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";

$result = del_member($_POST['id']);

if ($result == true){
	echo json_encode([ 'isSuccess' => $result]);
}
else{
	echo $result;
}
?>	