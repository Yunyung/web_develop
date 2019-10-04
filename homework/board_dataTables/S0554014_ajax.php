<?php  
$link = mysqli_connect("localhost", "root", "root123456", "board") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$arr_oper = array("insert" => "新增", "update" => "修改", "delete" => "刪除");
$oper = $_POST['oper'];
if ($oper == "query") {
      $sql = "select * from message";
      if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $a['data'][] = array($row["id"], $row["subject"], $row["name"], $row["content"], $row['time'], "<button type='button' class='btn btn-warning btn-xs' id='btn_update'><i class='glyphicon glyphicon-pencil'></i>修改</button> <button type='button' class='btn btn-danger btn-xs' id='btn_delete'><i class='glyphicon glyphicon-remove'></i>刪除</button>");
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}

if ($oper == "insert") {
      $sql = "INSERT INTO `message`(`subject`, `name`, `sex`, `mail`, `content`, `time`) VALUES ('{$_POST['message_subject']}', '{$_POST['message_author']}', 'M', 'aaaaa8787@123.456', '{$_POST['message_content']}', NOW())";
}

if ($oper == "update")
{
	$sql = "UPDATE `message` SET `subject` = '{$_POST['message_subject']}', `name` = '{$_POST['message_author']}', `content` = '{$_POST['message_content']}', `time` = NOW() WHERE `id` = '{$_POST['message_id_old']}'";
}

if ($oper == "delete") {
      $sql = "DELETE FROM `message` WHERE `id` = '{$_POST['message_id_old']}'";
}



if (strlen($sql) > 10) {
      if ($result = mysqli_query($link, $sql)) {
            $a["code"] = 0;
            $a["message"] = "資料" . $arr_oper[$oper] . "成功!";
      } else {
            $a["code"] = mysqli_errno($link);
            $a["message"] = "資料" . $arr_oper[$oper] . "失敗! <br> 錯誤訊息: " . mysqli_error($link) . ", sql: {$sql}";
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}

?>