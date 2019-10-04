<?php
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
$oper = $_POST['oper'];
if ($oper == "stop_launch")
{
	$result = stop_launch_movie($_POST['id'], $_POST['listOrder']);
}
else if ($oper == "launch"){
	$sql = "UPDATE `movie` SET `isLaunched` = 1 WHERE `id` = '{$_POST['id']}'";
	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query)
	{
		$result = add_listOrder($_POST['id'], $_POST['listOrder']);
	}
	else
	{
		$code = 1;
		$message = "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}
}
echo json_encode($result);

?>	