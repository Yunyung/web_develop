<?php
/*
 * 驗證ajax傳過來的 密碼 更新其密碼
 */
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";

$result = updateUserPassword($_POST['id'], $_POST['userPassword']);
echo json_encode([ 'isSuccess' => $result ]);


?>	