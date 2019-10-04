<?php
@session_start();
/**
 * A class file to connect to database
 */
// 啟動 session 儲存連線後的資訊

define('DB_USER', "root"); // db user
define('DB_PASSWORD', "root123456"); // db password
define('DB_DATABASE', "group_08"); // database name
define('DB_SERVER', "localhost"); // db server



$_SESSION['link'] = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
if ($_SESSION['link'])
{
	// 若為true，代表以正確連線
	// 設定編碼為UTF-8
	mysqli_query($_SESSION['link'], "SET NAMES utf8");
	// echo "以正確連線";
}
else
{
	// 否則就代表連線失敗 mysqli_connect_error() 顯示錯誤訊息
	echo '無法連線mysqli資料庫:' . mysqli_connect_error();
}

?>