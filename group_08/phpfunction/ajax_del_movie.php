<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}

$movie_id = $_POST['movie_id'];
$sql = "SELECT `cover_path` FROM `movie` WHERE `id` = '{$movie_id}'";
$query = mysqli_query($_SESSION['link'], $sql);
$row = mysqli_fetch_assoc($query);
$cover_path = $row['cover_path'];


$sql = "DELETE FROM `movie` WHERE `id` = '{$movie_id}'";
$query = mysqli_query($_SESSION['link'], $sql);
if ($query)
{
	if (mysqli_affected_rows($_SESSION['link']) >= 1)
	{

		$code = 0;
		$message = "成功刪除電影!";
		del_file($cover_path);

		// 刪除資料庫完成後, 刪除此照片folder中的所有圖片
		$sql = "SELECT * FROM `moviestills` WHERE `id` = '{$movie_id}'";
		$query = mysqli_query($_SESSION['link'], $sql);
		if ($query)
		{
			while ($row = mysqli_fetch_assoc($query))
			{
				$file_path = $row['still_path'];
				$del_file_Result = del_file($file_path);
				if ($del_file_Result['isSuccess'] == false)
				{
					echo json_encode($del_file_Result);
				}
			}
		}
		else  
		{
			$code = 1;
			$message = "查詢此電影的劇照失敗" . mysqli_error($_SESSION['link']) . ", SQL syntax: {$sql}";
		}

		// 刪除此電影資料庫中的still
		$sql = "DELETE FROM `moviestills` WHERE `id` = '{$movie_id}'";
		$query = mysqli_query($_SESSION['link'], $sql);
		if (!$query)
		{
			$code = 0;
			$message = "刪除此電影的劇照失敗" . mysqli_error($_SESSION['link']) . ", SQL syntax: {$sql}";
		}
	}
	else
	{
		$code = 3;
		$message = "無影響到的row, 刪除失敗!!" . mysqli_error($_SESSION['link']) . ", SQL syntax: {$sql}";
	}
}
else
{
	$code = 1;
	$message = "SQL syntax: {$sql} <br> mysqli_error:" . mysqli_error($_SESSION['link']);
}

echo json_encode(array('code' => $code, 'message' => $message));
?>