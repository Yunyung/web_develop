<?php
	$link = mysqli_connect("localhost", "root", "root123456", "board");
	if ($link){
		// encode
		mysqli_query($link, 'SET CHARACTER SET utf8');
		mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
	} 	
	else{
		echo "連結錯誤代碼: ".mysqli_connect_errno()."<br>";//顯示錯誤代碼
		echo "連結錯誤訊息: ".mysqli_connect_error()."<br>";//顯示錯誤訊息
		exit();
	}
	// 若有傳資料近來
	if ($_POST['name'] != ''){
		date_default_timezone_set('Asia/Taipei'); // 設定位置當前時區
		$current_time = date("Y-m-d H:i:s", time());
		$sql = "INSERT INTO `message` VALUES ('', '{$_POST['subject']}', '{$_POST['name']}', '{$_POST['sex']}', '{$_POST['mail']}', '{$_POST['content']}', '{$current_time}')";
		$result = mysqli_query($link, $sql);
		if ($result){
			echo "成功新增至留言板";
		}
		else{
			echo "{$sql} 新增至留言板失敗" . mysqli_error($link);
		}
	}
?>
<html>

<head>
<meta http-equiv="Content-Language" content="zh-tw">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>留言版</title>
</head>

<body>

<div align="center">
<span style="font-size:15pt;color:blue;font-weight:bold">訪客留言版</span>
<form name='form1' method='POST' action=''>
	<table border="1" width="500" id="table1">		
		<tr>
			<td width="100" align="center">姓 名</td>
			<td align="left"><input type='text' name='name' size='20'>　</td>
		</tr>
		<tr>
			<td width="100" align="center">性 別</td>
			<td align="left"><input type='radio' name='sex' value='M'>男 　<input type='radio' name='sex' value='F'>女　</td>
		</tr>
		<tr>
			<td width="100" align="center">E-mail</td>
			<td align="left"><input type='text' name='mail' size='30'>　</td>
		</tr>
		<tr>
			<td width="100" align="center">標  題</td>
			<td align="left"><input type='text' name='subject' size='50'>　</td>
		</tr>
		<tr>
			<td width="100" align="center">留言內容</td>
			<td align="left"><textarea name='content' rows='10' cols='50'></textarea></td>
		</tr>
		<tr>
			<td colspan='2' align="center"><input name='B1' type='submit' value=' 送 出 '>　<input name='B2' type='reset' value=' 回留言版 ' onclick="javascript:location.href='list.php'"></td>			
		</tr>
	</table>
</form>
<span></span>
</div>
	
</body>

</html>
