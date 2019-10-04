<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}

// $post_data = $_POST; 檢查post過來的data
// $file_data = $_FILES; 檢查post過來的file

// 取得最新一筆的movie id 用來raname 上傳的img 確保不會重複且可讀性高
$sql = "SHOW TABLE STATUS WHERE name = 'movie'"; // 取得表格資訊的SQL
$query = mysqli_query($_SESSION['link'], $sql);
if ($query){
    $row = mysqli_fetch_assoc($query);
    $NewMovie_id = $row['Auto_increment']; // 此筆新增的movie的id 現在的A.I值即為下一筆的ID
}
else{
    $code = 1;
    $message = "Get max movie id error, SQL error:" . "{$sql}" . ", mysqli_error:" . mysqli_error($_SESSION['link']);
    echo json_encode(array('code' => $code, 'message' => $message));
    exit;
}


$rate_array = array("普遍級", "保護級", "輔導級", "限制級");
/*
 * 存入資料庫的資料值設定
 */ 
$chi_name = $_POST['chi_name'];
$eng_name = (!(trim($_POST['eng_name']) == "")) ? "'" . $_POST['eng_name'] . "'": "NULL";

// 檢查封面檔案是否上傳成功, 若成功將路徑'$cover_path'存入資料庫
$upload_result = add_file_to_folder($NewMovie_id, $_FILES['cover_image'], "img/cover/");
if ($upload_result['isSuccess'])
{
    // 成功上傳 將檔案名稱存入放入指定cover_path
    $cover_path = $upload_result['newfilePath'];
}   
else
{
    echo json_encode($upload_result);
    exit;
}

$releaseDate  = (!(trim($_POST['releaseDate']) == "")) ? "'" . $_POST['releaseDate'] . "'" : "NULL";
$trailer_path = (!(trim($_POST['trailer_path']) == "")) ? "'" . $_POST['trailer_path'] . "'" : "NULL";
$introduce    = $_POST['introduce'];
$category     = implode(",", $_POST['category']);
if ($_POST['hour'] != -1 && $_POST['minute'] != -1){
    $Length = "'00:" . $_POST['hour'] . ":" . $_POST['minute'] . "'";
}
else{
    $Length = "NULL";
}
$directors    = implode(",", $_POST['directors']);
$actors       = implode(",", $_POST['actors']);
$price        = $_POST['price'];
$isLaunched   = $_POST['isLaunched'];
$isNewProduct = $_POST['isNewProduct'];
$rate         = $rate_array[$_POST['rate']];
$sql = "INSERT INTO `movie` (`chi_name`, `eng_name`, `cover_path`, `releaseDate`, `trailer_path`, `introduce`, `category`, `Length`, `directors`, `actors`, `price`, `isLaunched`, `isNewProduct`, `rate`) VALUES ('{$chi_name}', $eng_name, '{$cover_path}', $releaseDate, $trailer_path, '{$introduce}', '{$category}', $Length, '{$directors}', '{$actors}', '{$price}', '{$isLaunched}', '{$isNewProduct}', '{$rate}')";

$query = mysqli_query($_SESSION['link'], $sql);
if ($query){
    if (mysqli_affected_rows($_SESSION['link']) == 1){
        // 成功 繼續執行
    }
    else{
        $code = 3; // code 3 affected 失敗
        $message = "Insert Error no affected row!! SQL:" . "{$sql}" . ", mysqli_error:" . mysqli_error($_SESSION['link']);
        echo json_encode(array('code' => $code, 'message' => $message));
        exit;
    }
}
else{
    $code = 1;
    $message = "movie insert SQL syntax error:" . "{$sql}" . ", mysqli_error:" . mysqli_error($_SESSION['link']);
    echo json_encode(array('code' => $code, 'message' => $message));
    exit;
}


/* 
 *  電影排序設定  
 */
if (!($_POST['listOrder'] == "NULL")) // NULL 則代表下架, 無需排序
{
    $listOrderReorder_result = add_listOrder($NewMovie_id, $_POST['listOrder']);
    if ($listOrderReorder_result['code'] != 0){
        echo json_encode($listOrderReorder_result);
        exit;
    }
}

/*
 * 電影新增和排序設定完成 最後放入劇照至moviestills table
 */ 

// 改變file陣列的排列 方便模組化
$fileCount = count($_FILES['still_image']['name']);
if ($fileCount > 0){
    $currentTimeStamp = time();
    for ($i = 0;$i < $fileCount;$i++)
    {
        // 檢查檔案是否上傳成功, 若成功將路徑存入資料庫
        if ($_FILES['still_image']['error'][$i] === UPLOAD_ERR_OK)
        {
            while (true){
                // rename file  新檔案名稱格式=> id_timestamp.filetype
                $temp = explode(".", $_FILES['still_image']['name'][$i]); // 切割檔名、附檔名 方便rename
                $newfilename = $NewMovie_id . '_' . $currentTimeStamp . '.' . end($temp); 
                // echo "新檔案名稱: {$newfilename}";

                # 檢查檔案是否已經存在 若存在則刷新timestamp 不存在則跳出while 存入資料庫
                if (file_exists('../img/still/' . $newfilename)) 
                    $currentTimeStamp++;
                else{
                    $currentTimeStamp++; // 為下一張劇照先++
                    break; // 跳出while迴圈
                }
            }

            $dest = '../img/still/' . $newfilename;
            # 將檔案移至指定位置
            if (move_uploaded_file($_FILES['still_image']['tmp_name'][$i], $dest)){
                $still_path = 'img/still/' . $newfilename; // 存入資料庫的路徑
                $sql = "INSERT INTO `moviestills`VALUES ('{$NewMovie_id}', '{$still_path}')";
                $query = mysqli_query($_SESSION['link'], $sql);
                if (!$query){
                    $code = 1;
                    $message = "still image=> occur SQL error, SQL syntax:" . "{$sql}" . ", mysqli_error:" . mysqli_error($_SESSION['link']);
                    echo json_encode(array('id' => $fileCount,'code' => $code, 'message' => $message));
                    exit;
                }
            }
            else{
                $code = 2;
                $message = "Move still image Error, still_image name:" . $_FILES['still_image']['name'][$i];
                echo json_encode(array('code' => $code, 'message' => $message));
                exit;
            }
        }
    }
}


$code = 0;
$message = "電影新增成功!!";
echo json_encode(array('code' => $code, 'message' => $message));
?>