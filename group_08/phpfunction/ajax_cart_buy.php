<?php
require_once '../DB_Setting/DB.php';

if (!(isset($_SESSION['is_Login']))){
	echo json_encode(['isSuccess' => false, 'is_Login' => false]);
	exit;
}
$userAccount = $_SESSION['userAccount'];
$movieID = $_POST['movieID'];

$sql = "SELECT * FROM cart WHERE userAccount = '{$userAccount}' and movieID = '{$movieID}'";
$query = mysqli_query($_SESSION['link'],$sql);
$result = false;

if (mysqli_num_rows($query) >= 1){
	$sql ="UPDATE cart SET state = '已結帳' WHERE userAccount = '{$userAccount}' and movieID = '{$movieID}'";
	$query = mysqli_query($_SESSION['link'],$sql);
	$result = true;
}else{
	$sql = "INSERT INTO cart VALUES ('$userAccount','$movieID','已結帳', NOW())";
	$query = mysqli_query($_SESSION['link'],$sql);
	$result = true;
}



if ($result == true){
	echo json_encode([ 'isSuccess' => $result]);
}
else{
	echo mysqli_error();
}
?>	