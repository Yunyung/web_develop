<?php
@session_start();
require_once '../DB_Setting/DB.php';

if (!(isset($_SESSION['is_Login']))){
	echo json_encode(['isSuccess' => false, 'is_Login' => false]);
	exit;
}
$result = false;
$userAccount = $_SESSION['userAccount'];
$movieID = $_POST['movieID'];

$sql = "INSERT INTO cart VALUES ('$userAccount','$movieID','待付款', NOW())";
$query = mysqli_query($_SESSION['link'],$sql);

if ($query)
{
	if (mysqli_affected_rows($_SESSION['link']) >= 1){
		$result = true;
	}	
}
else
{
	$result = "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
}


if ($result == true){
	echo json_encode(['isSuccess' => true, 'is_Login' => true]);
}
else{
	echo $result;
}
?>	