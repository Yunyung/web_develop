<?php
require_once '../DB_Setting/DB.php';

$userAccount = $_SESSION['userAccount'];
$movieID = $_POST['movieID'];

$sql = "DELETE FROM cart WHERE userAccount = '{$userAccount}' and movieID = '{$movieID}'";
$query = mysqli_query($_SESSION['link'],$sql);

if ($query)
{
	if (mysqli_affected_rows($_SESSION['link']) >= 1){
		$result = true;
	}	
}
else
{
	echo "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
}

if ($result == true){
	echo json_encode([ 'isSuccess' => $result]);
}
else{
	echo $result;
}
?>	