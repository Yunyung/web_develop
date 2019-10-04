<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}
$id = $_POST['id'];
$old_cover_path = $_POST['old_cover_path'];

$AddFileResult = add_file_to_folder($id, $_FILES['new-cover-img'], "img/cover/");
if ($AddFileResult['isSuccess']){
	$newfilePath = $AddFileResult['newfilePath']; // 新的檔案路徑
	$removeResult = del_file($old_cover_path);
	if ($removeResult['isSuccess'])
	{
		$sql = "UPDATE `movie` SET `cover_path` = '{$newfilePath}' WHERE `id` = '{$id}'";
		$query = mysqli_query($_SESSION['link'], $sql);
		if ($query)
		{
			$code = 0;
			$message = "更新封面照片成功!";
		}
		else
		{
			$code = 1;
			$message = "SQL syntax: {$sql} <br> mysqli_error:" . mysqli_error($_SESSION['link']);
		}
	}
	else{
		$code = $removeResult['code'];
		$message = $removeResult['message'];
	}
}
else{
	$code = $AddFileResult['code'];
	$message = $AddFileResult['message'];
}

echo json_encode(array('code' => $code, 'message' => $message));

?>