<?php
/*
 * 驗證ajax傳過來的 用戶名 是否有重複
 */
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";

$result = check_has_userAccount($_POST['userAccount']);
echo json_encode([ 'isExist' => $result ]);


?>	