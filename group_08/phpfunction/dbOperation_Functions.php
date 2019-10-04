<?php
@session_start(); 

/**
 * 檢查資料庫是否存在此userAccount
 */
function check_has_userAccount($userAccount){
	
	$result = null;
	$sql = "SELECT * FROM `user` WHERE `userAccount` = '{$userAccount}'"; 

	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功
	if ($query)
	{
		if (mysqli_num_rows($query) >= 1){
			$result = true;
		}	
	}
	else
	{
		// 執行失敗
		echo "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}
	return $result;
}

/**
 * 新增使用者
 */
function addNewUser($name, $userAccount, $userPassword, $sex, $dateOfBirth,$Email, $mobile, $userNickname, $rank)
{
	$result = null;
	$userPassword = md5($userPassword); // 將密碼加密
	$sql = "INSERT INTO `user` (`name`, `userAccount`, `userPassword`, `sex`, `dateOfBirth`, `Email`, `mobile`, `userNickname`, `signUpDate`, `rank`) VALUES ('{$name}', '{$userAccount}', '{$userPassword}', '{$sex}', '{$dateOfBirth}', '{$Email}', '{$mobile}', '{$userNickname}', NOW(), '{$rank}')";

	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功
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
	return $result;
}

/**
 *  修改使用者資料
 */
function updateUser($id, $name, $userAccount, $sex, $dateOfBirth, $Email, $mobile, $userNickname, $rank)
{
	$result = null;
	$sql="UPDATE `user` SET `name` = '{$name}', `userAccount` =  '{$userAccount}', `sex` =  '{$sex}',  `dateOfBirth` =  '{$dateOfBirth}', `Email` =  '{$Email}', `mobile` =  '{$mobile}', `userNickname` =  '{$userNickname}', `rank` =  '{$rank}' WHERE  `id` =  '{$id}'";

	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功
	if ($query)
	{
		// if (mysqli_affected_rows($_SESSION['link']) >= 1){
			$result = true;
	}
	else
	{
		echo "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}

	return $result;
}

/**
 * 驗證使用者登入
 */
function Verify_userLogin($userAccount, $userPassword)
{
	$result = null;
	$userPassword = md5($userPassword); // 先密碼加密後驗證
	$sql = "SELECT * FROM `user` WHERE `userAccount` = '{$userAccount}' and `userPassword` = '{$userPassword}'";
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功
	if ($query)
	{
		if (mysqli_num_rows($query) >= 1){
			$user = mysqli_fetch_assoc($query);
			

			/**
			 * 將會員登入訊息放入Session傳遞
			 */
			$_SESSION['is_Login'] = true; 					// 確認登入
			$_SESSION['id'] =  $user['id'];					// user primary key
			$_SESSION['userAccount'] = $user['userAccount'];// 用戶名稱
			$_SESSION['rank'] = $user['rank'];				// 用戶權限(一般使用者、管理員)
			
			$result = true; // 回傳 正確登入結果
		}	
	}
	else
	{
		echo "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}
	return $result;
}


/** backend operation **/

/**
 * 驗證使用者登入
 */
function del_member($id)
{
	$result = null;

	$sql = "DELETE FROM `user` WHERE `id` = '{$id}'";
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功
	if ($query)
	{
		if (mysqli_affected_rows($_SESSION['link']) >= 1){
			$result = true; // 回傳 正確登入結果
		}	
	}
	else
	{
		echo "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}
	return $result;
}

/**
 * 下架某一商品
 */
function stop_launch_movie($id, $listOrder)
{
	$code = -1;
	$message = "";
	// 將listOrder(列表排序值)設為NULL 並調整整體排序值
	$sql = "UPDATE `movie` SET `listOrder` = NULL WHERE `id` = '{$id}'";
	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query)
	{
		// 調整整體排序值
		$sql = "UPDATE `movie` SET `listOrder` = `listOrder` - 1 WHERE `listOrder` > '{$listOrder}'";
		$query = mysqli_query($_SESSION['link'], $sql);
		if ($query)
		{
			$sql = "UPDATE `movie` SET `isLaunched` = 0 WHERE `id` = '{$id}'";
			$query = mysqli_query($_SESSION['link'], $sql);
			if ($query)
			{
				$code = 0;
				$message = "成功! 完成reoder和停止上架";
			}
		}
	}
	else
	{
		$code = 1;
		$message = "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}
	// 如果請求成功
	$result = array('code' => $code,'message' => $message);
	return $result;
}

function updateUserPassword($id, $userPassword){
	$result = null;
	$userPassword = md5($userPassword); // 先密碼加密
	$sql = "UPDATE `user` SET `userPassword` = '{$userPassword}' WHERE `id` = '{$id}'";
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功
	if ($query)
	{
		// 欲使用但若相同會沒有影響
		// if (mysqli_affected_rows($_SESSION['link']) >= 1){
			$result = true; // 成功更改密碼
	}
	else
	{
		$result = "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}
	return $result;
}


function isPasswordMatch($id, $userPassword){
	$result = null;
	$userPassword = md5($userPassword); // 先密碼加密後再比對
	$sql = "SELECT `userPassword` FROM `user` WHERE `id` = '{$id}'";

	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query){
		if (mysqli_num_rows($query) == 1){
			$row = mysqli_fetch_assoc($query);

			if ($userPassword == $row['userPassword']){
				$result = true;
			}
		}
	}
	else{
		$result =  "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}

	return $result;

}

function sortableMovieListOrder($Item_id, $ItemOldIndex, $ItemNewIndex){
	$code = -1;
	$message = "";
	if ($ItemOldIndex < $ItemNewIndex){
		// 受牽連的item 皆向前移動1格
		$sql = "UPDATE `movie` SET `listOrder` = `listOrder` - 1 WHERE `listOrder` >= ($ItemOldIndex + 1) AND `listOrder` <= $ItemNewIndex";
		$query = mysqli_query($_SESSION['link'], $sql);
		if ($query && mysqli_affected_rows($_SESSION['link']) >= 1){
			// 指定item移至後方
			$sql = "UPDATE `movie` SET `listOrder` = $ItemNewIndex WHERE `id` = '{$Item_id}'";
			$query = mysqli_query($_SESSION['link'], $sql);
			if ($query && mysqli_affected_rows($_SESSION['link']) >= 1){
				$code = 0;
				$message = "Success move item from 'smaller' order to 'bigger' order!";
			}
			else{
				$code = 1;
			}
		}
		else{
			$code = 1;
		}
	}
	else if ($ItemOldIndex > $ItemNewIndex){
		// 受牽連的item 皆向後移動1格
		$sql = "UPDATE `movie` SET `listOrder` = `listOrder` + 1 WHERE `listOrder` <= ($ItemOldIndex - 1) AND `listOrder` >= $ItemNewIndex";
		$result = mysqli_query($_SESSION['link'], $sql);
		if ($result && mysqli_affected_rows($_SESSION['link']) >= 1){
			// 指定item移至前方
			$sql = "UPDATE `movie` SET `listOrder` = '{$ItemNewIndex}' WHERE `id` = '{$Item_id}'";
			$query = mysqli_query($_SESSION['link'], $sql);
			if ($query && mysqli_affected_rows($_SESSION['link']) >= 1){
				$code = 0;
				$message = "Success move item from 'bigger' order to 'smaller' order!";
			}
			else{
				$code = 1;
			}
		}
		else{
			$code = 1;
		}
	}
	else{
		// item位置不變
		$code = 0;
		$message = "Success! position no change";
	}

	if ($code != 0){
		$message = "SQL Syntax: {$sql}" . "<br>" . "Error Message:" . mysqli_error($_SESSION['link']);
	}
	$result = array('code' => $code,'message' => $message);
	return $result;
}
/*
 * 電影排序設定->將listOrder size + 1 把新加入(或上架)的電影放入指定的Order, 並調整其他電影的Order
 * 
 */
function add_listOrder($id, $listOrder){
	$code = -2;
	$message = "";
	// 將大於等於此movie傳入的排序值的每一個move listOrder往後一格(listOrder +1 ), 
	$sql = "UPDATE `movie` SET `listOrder` = `listOrder` + 1 WHERE `listOrder` >= '$listOrder'";
	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query)
	{
		// 設定傳入的movie的排序值
		$sql = "UPDATE `movie` SET `listOrder` = '{$listOrder}' WHERE `id` = '{$id}'"; 
	    $query = mysqli_query($_SESSION['link'], $sql);
	    if (!$query){
	        $code = 1;
	        $message = "Update new movie listOder error, SQL syntax error:{$sql}.";
	    }
	    else if (mysqli_affected_rows($_SESSION['link']) == 1){
	    	$code = 0;
	    	$message = "ReOrder Success!";
	    }
	}
	else
	{
		$code = 1;
    	$message = "Update listOder error, SQL syntax error:{$sql}.";
	}

	$result = array('code' => $code,'message' => $message);
	return $result;
}
/*
 * 改變file的排列方式 http://php.net/manual/zh/reserved.variables.files.php
 */
function diverse_array($vector) { 
    $result = array(); 
    foreach($vector as $key1 => $value1) 
        foreach($value1 as $key2 => $value2) 
            $result[$key2][$key1] = $value2; 
    return $result; 
} 

/*
 *  @param => $id : 對應file的資料ID 僅用來設定file部分名稱
 *  @param => $file : 一筆file的資料;
 *  @param => $folder_path : 相對於group_08目錄的資料夾位置
 */

function add_file_to_folder($id, $file, $folder_path){
	$isSuccess = false;
	$code = 0;
	$message = "";
	$newfilePath = null;
	if ($file['error'] === UPLOAD_ERR_OK)
	{
	    $currentTimeStamp = time();
	    while (true){
	        /* rename file  新檔案名稱格式=> id_timestamp.filetype */
	        $temp = explode(".",  $file['name']); // 切割檔名、附檔名 方便rename
	        $newfilename = $id . '_' . $currentTimeStamp . '.' . end($temp); 
	        // echo "新檔案名稱: {$newfilename}";

	        # 檢查檔案是否已經存在 若存在則刷新timestamp 不存在則跳出while 存入資料庫
	        if (file_exists('../' . $folder_path . $newfilename)) 
	            $currentTimeStamp++;
	        else break; // 跳出while迴圈
	    }

	    $dest = '../' . $folder_path . $newfilename;
	    # 將檔案移至指定位置
	    if (move_uploaded_file($file['tmp_name'], $dest)){
	    	$isSuccess = true;
	    	$message = "成功移動檔案";
	    	$newfilePath = $folder_path . $newfilename; // 成功移動 將newfilePath設值
	    }
	    else{
	    	$code = 2; // code 2 檔案失敗
	        $message = "移動檔案失敗";
	    }
	}   
	else{
		$code = 2;
		$message = 'FILES upload Error-> Error code' . $_FILES['cover_image']['error'];
	}
	$result = array('isSuccess' => $isSuccess, 'code' => $code,'message' => $message, 'newfilePath' => $newfilePath);
	return $result; // 回傳result 陣列
}

function del_file($file_path_del){
	$isSuccess = false;
	$code = 0;
	$message = "";
	if (unlink("../" . $file_path_del))
	{
		$isSuccess = true;
	    $message = "Delete file Success";
	}
	else{
		$code = 2;
		$message = "del file error, file path you want to delete: '{$file_path_del}'";
	}
	$result = array('isSuccess' => $isSuccess, 'code' => $code,'message' => $message);
	return $result;
}

?>