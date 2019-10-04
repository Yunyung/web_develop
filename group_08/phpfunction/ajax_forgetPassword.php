<?php
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";


$code = -1;
$message = "";
$oper = $_POST['oper'];
if ($oper == "getResetCode")
{
	$userAccount = $_POST['userAccount'];
	$Email = $_POST['Email'];

	$sql = "SELECT `id`, `userAccount` FROM `user` WHERE `userAccount` = '{$userAccount}' AND `Email` = '{$Email}'";


	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功
	if ($query)
	{
		if (mysqli_num_rows($query) == 1){
			$code = 0;
			$md5_userAccount = md5($userAccount);
			$message = "驗證成功!! <br><span class='movieAzureAlert'>會員:". $userAccount ." </span>現在可以重新設定密碼, 請點選<a href='resetPassword.php?resetCode={$md5_userAccount}'>超連結</a>重新設定密碼";
		}
		else{
			$code = 3;
			$message = "輸入的帳號及信箱並不符合!!";
		}
	}
	else
	{
		// sql 執行失敗
		$code = 1;
		$message = "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}
}
else if ($oper == "updatePassword")
{
	// 確認是哪個使用者, 全部帳號讀出來之後一一進行md5比對
	if (!isset($_POST['resetCode'])){
		$code = 10;
		$message = "錯誤 resetCode呢?!";
	}
	else
	{
		$id = $_POST['id'];
		$new_userPassword = $_POST['new_userPassword'];
	    $sql = "SELECT `userAccount` FROM `user` WHERE `id` = '{$id}'";
	    $query = mysqli_query($_SESSION['link'], $sql);
	    // 如果請求成功
	    if ($query)
	    {
	        if (mysqli_num_rows($query) == 1){
	            $row = mysqli_fetch_assoc($query);
	            if ($_POST['resetCode'] == md5($row['userAccount']))
	            {
	            	$result = updateUserPassword($id, $new_userPassword);
	            	if ($result)
	            	{
	            		$code = 0;
	            		$meesage = "密碼更改成功!請重新登入";
	            	}
	            }
	            else
	            {
	            	$code = 10;
					$message = "resetCode比對錯誤!!";
	            }
	        }
	    }
	    else{
	    	// sql 執行失敗
			$code = 1;
			$message = "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	    }
	}
	
}


$result = array('code' => $code,'message' => $message);
echo json_encode($result);

?>	