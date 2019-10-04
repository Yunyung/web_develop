<?php
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";

$result = addNewUser($_POST['name'], $_POST['userAccount'], $_POST['userPassword'], $_POST['sex'], $_POST['dateOfBirth'], $_POST['Email'], $_POST['mobile'], $_POST['userNickname'], "normal");

if ($result == true){
	echo json_encode([ 'isSuccess' => $result]);
}
else{
	echo $result;
}
?>	