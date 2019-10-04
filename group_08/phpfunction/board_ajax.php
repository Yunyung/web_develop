<?php
if ($_POST['oper'] == 'qry_movie') {
    $link = mysqli_connect("localhost", "root", "root123456", "group_08") //建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $sql = "select * from movie "; // 指定SQL查詢字串
    // 送出查詢的SQL指令
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr_movie["movie_id"][] = $row["id"];
            $arr_movie["movie_name"][] = $row["chi_name"];
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    mysqli_close($link); // 關閉資料庫連結
    echo json_encode($arr_movie);
    exit;
}
if ($_POST['oper'] == 'qry_department') {
    $movie_n_id = $_POST['movie_n_id'];
    $link = mysqli_connect("localhost", "root", "root123456", "group_08") //建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    if($movie_n_id == -1)
        $sql = "select * from board,user,movie WHERE board.user_id=user.id and board.movie_id=movie.id";
    else
        $sql = "select * from board,user,movie WHERE movie_id='$movie_n_id' and board.user_id=user.id and board.movie_id=movie.id";
    // 送出查詢的SQL指令
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr_dept["mes_id"][] = $row["mes_id"];
            $arr_dept["user_id"][] = $row["user_id"];
            $arr_dept["user_name"][] = $row["name"];
            $arr_dept["user_nick_name"][] = $row["userNickname"];
            $arr_dept["movie_id"][] = $row["movie_id"];
            $arr_dept["movie_chi"][] = $row["chi_name"];
            $arr_dept["movie_eng"][] = $row["eng_name"];
            $arr_dept["content"][] = $row["content"];
            $arr_dept["mes_date"][] = $row["mes_date"];
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    mysqli_close($link); // 關閉資料庫連結
    echo json_encode($arr_dept);
    exit;
}
if ($_POST['oper'] == 'load') {
    
    $link = mysqli_connect("localhost", "root", "root123456", "group_08") //建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    
        $sql = "select * from board,user,movie WHERE board.user_id=user.id and board.movie_id=movie.id";
    
    // 送出查詢的SQL指令
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr_dept["mes_id"][] = $row["mes_id"];
            $arr_dept["user_id"][] = $row["user_id"];
            $arr_dept["user_name"][] = $row["name"];
            $arr_dept["user_nick_name"][] = $row["userNickname"];
            $arr_dept["movie_id"][] = $row["movie_id"];
            $arr_dept["movie_chi"][] = $row["chi_name"];
            $arr_dept["movie_eng"][] = $row["eng_name"];
            $arr_dept["content"][] = $row["content"];
            $arr_dept["mes_date"][] = $row["mes_date"];
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    mysqli_close($link); // 關閉資料庫連結
    echo json_encode($arr_dept);
    exit;
}
if ($_POST['oper'] == 'add') {
    
    $link = mysqli_connect("localhost", "root", "root123456", "group_08") //建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    
    $sql = "INSERT INTO board (user_id,movie_id,content,mes_date) value('".$_POST['user_id']."','".$_POST['movie_id']."','".$_POST['content']."',NOW())";
    echo $sql;
    
    mysqli_query($link,$sql);
    
    
    mysqli_close($link); // 關閉資料庫連結
    
    exit;
}
if ($_POST['oper'] == 'update') {
    
    $link = mysqli_connect("localhost", "root", "root123456", "group_08") //建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $mid=$_POST['movie_id'];
    $cnt=$_POST['content'];
    $mesid=$_POST['mes_id'];
    $sql = "update board set movie_id='$mid',content='$cnt' where mes_id='$mesid'";
   
    echo $sql;
    
    mysqli_query($link,$sql);
    
    
    mysqli_close($link); // 關閉資料庫連結
    
    exit;
}
if ($_POST['oper'] == 'del') {
    
    $link = mysqli_connect("localhost", "root", "root123456", "group_08") //建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $mesid=$_POST['mes_id'];
    $sql = "DELETE FROM  board where mes_id='$mesid'";
    
    
    mysqli_query($link,$sql)or die ("無法刪除".mysql_error()); //執行sql語法
    
    
    
    mysqli_close($link); // 關閉資料庫連結

    
    exit;
}
if ($_POST['oper'] == 'load_form') {
    
    $link = mysqli_connect("localhost", "root", "root123456", "group_08") //建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $mes_id=$_POST['mes_id'];
    $sql = "SELECT * FROM board WHERE mes_id='$mes_id'";
    
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $mov_arr["mes_id"][] = $row["mes_id"];
            $mov_arr["user_id"][] = $row["user_id"];
            $mov_arr["movie_id"][] = $row["movie_id"];
            $mov_arr["content"][] = $row["content"];
            $mov_arr["mes_date"][] = $row["mes_date"];
        }
        mysqli_free_result($result); // 釋放佔用的記憶體
    }
    mysqli_close($link); // 關閉資料庫連結
    echo json_encode($mov_arr);
    exit;
}
?>