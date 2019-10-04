<?php
$link = mysqli_connect("localhost", "root", "root123456", "group_08") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$arr_oper = array("insert" => "新增", "update" => "修改", "delete" => "刪除");
$oper = $_POST['oper'];
if ($oper == "query") {
      $sql = "select * from board";
      if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $a['data'][] = array($row["mes_id"], $row["user_id"], $row["movie_id"], $row["content"],$row["mes_date"], "<button type='button' class='btn btn-success movieBtn btn-xs' id='btn_update'><i class='glyphicon glyphicon-pencil'></i>修改</button> <button type='button' class='btn btn-danger movieBtn btn-xs' id='btn_delete'><i class='glyphicon glyphicon-remove'></i>刪除</button>");
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
      }
      mysqli_close($link); // 關閉資料庫連結
      echo json_encode($a);
      exit;
}
if ($oper == "insert") {
      $sql = "insert into board(mes_id,user_id,movie_id,content,mes_date) values ('" . $_POST['mes_id'] . "','" . $_POST['user_id'] . "','" . $_POST['movie_id'] . "','" . $_POST['content'] ."','" . $_POST['mes_date'] . "')";
}
if ($oper == "update") {
      $sql = "update board set user_id='" . $_POST['user_id'] . "',movie_id='" . $_POST['movie_id'] . "',content='" . $_POST['content'] ."',mes_date='" . $_POST['mes_date'] . "' where mes_id='" . $_POST['mes_id_old'] . "'";
}
if ($oper == "delete") {
      $sql = "delete from board where mes_id='" . $_POST['mes_id_old'] . "'";
}

if (strlen($sql) > 10) {
      if ($result = mysqli_query($link, $sql)) {
            $a["code"] = 0;
            $a["message"] = "資料" . $arr_oper[$oper] . "成功!";
      } else {
            $a["code"] = mysqli_errno($link);
            $a["message"] = "資料" . $arr_oper[$oper] . "失敗! <br> 錯誤訊息: " . mysqli_error($link);
      }
      mysqli_close($link); // 關閉資料庫連結
      echo json_encode($a);
      exit;
}
?>