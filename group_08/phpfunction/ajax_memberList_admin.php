<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
$arr_oper = array('insert' => "新增", 'update' => "修改", 'delete' => "刪除");
$sex = array('M' => "男", 'F' => "女");
$rank = array('normal' => "一般會員", 'admin' => "管理者");
$oper = $_POST['oper'];

$result; // 儲存CRUD 執行成功與否(boolean)
if ($oper == "query"){
	$sql = "SELECT * FROM `user`";
	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query){
		while ($row = mysqli_fetch_assoc($query))
		{
			$a['data'][] = array('id' => $row['id'],
								 'name' => $row['name'],
								 'userAccount' => $row['userAccount'],
								 'sex' => $sex[$row['sex']],
								 'dateOfBirth' => $row['dateOfBirth'],
								 'Email' => $row['Email'],
								 'mobile' => $row['mobile'],
								 'userNickname' => $row['userNickname'],
								 'signUpDate' => $row['signUpDate'],
								 'rank' => $rank[$row['rank']],
								 'button' => "<button type='button' class='btn btn-info btn-sm movieBtn' id='btn_update'><i class='far fa-edit'></i>修改</button> <button type='button' class='btn btn-danger btn-sm movieBtn' id='btn_delete'><i class='far fa-trash-alt'></i>刪除</button>"
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
	$result = del_member($_POST['user_id']);
}

if ($oper == "insert"){
	$result = addNewUser($_POST['name'], $_POST['userAccount'], $_POST['userPassword'], $_POST['sex'], $_POST['dateOfBirth'], $_POST['Email'], $_POST['mobile'], $_POST['userNickname'], $_POST['rank']);
}

if ($oper == "update"){
	$result = updateUser($_POST['user_id'], $_POST['name'], $_POST['userAccount'], $_POST['sex'], $_POST['dateOfBirth'], $_POST['Email'], $_POST['mobile'], $_POST['userNickname'], $_POST['rank']);
}

if ($result){
	// 成功
	$a["code"] = 0;
    $a["message"] = "資料" . $arr_oper[$oper] . "成功!";
}
else{
	// 失敗
	$a["code"] = mysqli_errno($_SESSION['link']);
    $a["message"] = "資料" . $arr_oper[$oper] . "失敗! <br> 錯誤訊息: " . mysqli_error($_SESSION['link']);
}
echo json_encode($a);
exit;

	

?>