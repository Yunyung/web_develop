<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
$arr_oper = array('insert' => "新增", 'update' => "修改", 'delete' => "刪除");

$oper = $_POST['oper'];
$result; // 儲存CRUD 執行成功與否(boolean)
if ($oper == "query"){
	$sql = "SELECT `userAccount`, `movieID`, `chi_name`, `state`, `date` FROM `cart` AS A, `movie` AS B WHERE A.movieID = B.ID";
	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query){
		
		while ($row = mysqli_fetch_assoc($query))
		{
			$a['data'][] = array('userAccount' => $row['userAccount'],
								 'movieID' => "#" . $row['movieID'],
								 'chi_name' => "<a href='../movieDetail.php?id={$row['movieID']}'>" . $row['chi_name'] . "</a>",
								 'state' => $row['state'],
								 'date' => $row['date'],
								 'button' => "<button type='button' class='btn btn-danger btn-sm movieBtn' id='btn_delete'><i class='far fa-trash-alt'></i>刪除</button>"
								); 
		}
		mysqli_free_result($query); // 釋放佔用的記憶體
		echo json_encode($a);
	}
	else{
		echo json_encode(mysqli_error());
	}
	exit;
}

if ($oper == "delete") {
	$userAccount = $_POST['userAccount'];
	$movieID = substr($_POST['movieID'], 1); // 去掉井字號 substr
	$sql = "DELETE FROM `cart` WHERE `userAccount` = '{$userAccount}' AND `movieID` = '{$movieID}'";
}

if ($query = mysqli_query($_SESSION['link'], $sql)) {
    $a["code"] = 0;
    $a["message"] = "資料" . $arr_oper[$oper] . "成功!";
} else {
    $a["code"] = 1;
    $a["message"] = "資料" . $arr_oper[$oper] . "失敗! <br> 錯誤訊息: " . mysqli_error($_SESSION['link']);
}

echo json_encode($a);
exit;

?>