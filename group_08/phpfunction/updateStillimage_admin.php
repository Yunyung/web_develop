<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}

$id = $_POST['movie_id'];

// print_r($_FILES);
// 改變file陣列的排列 方便模組化
$upload = diverse_array($_FILES['still_image']);
// print_r($upload);
$fileCount = count($upload);
for ($i = 0;$i < $fileCount;$i++)
{
	$AddFileResult = add_file_to_folder($id, $upload[$i], "img/still/");
	if ($AddFileResult['isSuccess']){
		$newfilePath = $AddFileResult['newfilePath']; // 新的檔案路徑
		$sql = "INSERT INTO `moviestills` VALUES ('{$id}', '{$newfilePath}')";
		$query = mysqli_query($_SESSION['link'], $sql);
		if (!$query)
		{
			$code = 1;
			$message = "SQL syntax: {$sql} <br> mysqli_error:" . mysqli_error($_SESSION['link']);
			echo json_encode(array('code' => $code, 'message' => $message));
			exit;
		}
	}
	else{
		echo json_encode($AddFileResult);
		exit;
	}
}
$code = 0;
$message = "上傳劇照照片成功!";
echo json_encode(array('code' => $code, 'message' => $message));


?>