<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}

$oper_array = array('still' => "劇照");
$oper = $_POST['oper'];
if ($oper == "still"){
	// 劇照刪除
	$movie_id = $_POST['movie_id'];
	$file_path = $_POST['file_path'];
	$sql = "DELETE FROM `moviestills` WHERE `id` = '{$movie_id}' AND `still_path` = '{$file_path}'";
}

$query = mysqli_query($_SESSION['link'], $sql);
if ($query)
{
	if (mysqli_affected_rows($_SESSION['link']) >= 1)
	{
		// 資料庫刪除完成後,才真正刪除file
		$removeResult = del_file($file_path);
		if ($removeResult['isSuccess'])
		{
			$code = 0;
			$message = "刪除" . $oper_array[$oper] . "成功!";
		}
		else
		{
			$code = $removeResult['code'];
			$message = $removeResult['message'];
		}
	}
	else
	{
		$code = 2;
		$message = "資料庫刪除失敗!!" . mysqli_error($_SESSION['link']) . ", SQL syntax: {$sql}";
	}
}
else
{
	$code = 1;
	$message = "SQL syntax: {$sql} <br> mysqli_error:" . mysqli_error($_SESSION['link']);
}

echo json_encode(array('code' => $code, 'message' => $message));


?>