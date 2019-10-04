<?php
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";

$isUserPasswordMatch = isPasswordMatch($_POST['id'], $_POST['old_userPassword']);
if ($isUserPasswordMatch){
	if (updateUserPassword($_POST['id'], $_POST['new_userPassword'])){
		$code = 0;
		$message = "更新密碼成功";
	}
	else{
		$code = 1;
		$message = "資料庫更新操作發生錯誤";
	}
}
else{
	$code = 2;
	$message = "舊密碼輸入錯誤，請輸入正確密碼";
}
echo json_encode([ 'code' => $code, 'message' => $message , 'isUserPasswordMatch' => $isUserPasswordMatch]);

?>	