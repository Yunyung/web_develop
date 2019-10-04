<?
    /*
     * 
     */
	@session_start();
    if (!(isset($_SESSION['is_Login']) && $_SESSION['is_Login'])){
        header("Location: ../memberLogin.php");
    }
	require_once '../DB_Setting/DB.php';
	$sex = $_POST['sex'];
	$Email = $_POST['Email'];
	$mobile = $_POST['mobile'];
	$userNickname = $_POST['userNickname'];
	$sql="UPDATE `user` SET `sex` = '{$sex}', `Email` = '{$Email}', `mobile` = '{$mobile}', `userNickname` = '{$userNickname}' WHERE  `id` = {$_SESSION['id']}";

	$query = mysqli_query($_SESSION['link'], $sql);

	if ($query){
		header("Location: ../memberAccount.php");
	}
	else{
		echo "sql:{$sql}" . mysqli_error($_SESSION['link']);
	}
?>