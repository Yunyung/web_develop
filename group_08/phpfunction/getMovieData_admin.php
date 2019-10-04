<?php
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
$movie_id = $_POST['movie_id'];
$sql = "SELECT * FROM `movie` WHERE `id` = '{$movie_id}'";
$query = mysqli_query($_SESSION['link'], $sql);

$code = 0;
$message = "";
$movie_data = NULL;
if ($query)
{
	if (mysqli_num_rows($query) == 1){
		$row = mysqli_fetch_assoc($query);
		$code = 0;
		$message = "成功取得資料!";
	}
	else{
		$code = 3;
		$message = "SQL syntax: {$sql} , 取得指定ID資料失敗!";
	}
}
else{
	$code = 1;
	$message = "SQL syntax: {$sql} <br> mysqli_error:" . mysqli_error($_SESSION['link']);
}

echo json_encode([ 'code' => $code, 'message' => $message, 'movie_data' => $row ]);

?>	