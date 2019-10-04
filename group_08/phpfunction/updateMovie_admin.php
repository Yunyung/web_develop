<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}
// 沒有傳入要更改的電影id
if ($_POST['movie_id'] == ""){
	header("Location: ../memberLogin.php");
}

$movie_id = $_POST['movie_id'];

$rate_array = array("普遍級", "保護級", "輔導級", "限制級");
$chi_name = $_POST['chi_name'];
$eng_name = (!(trim($_POST['eng_name']) == "")) ? "'" . $_POST['eng_name'] . "'": "NULL";

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



$sql = "UPDATE `movie` SET  `chi_name`     = '{$chi_name}',
							`eng_name`     = $eng_name,
							`releaseDate`  = $releaseDate,
							`trailer_path` = $trailer_path,
							`introduce`    = '{$introduce}',
							`category`     = '{$category}',
							`Length`       = $Length,
							`directors`    = '{$directors}',
							`actors`       = '{$actors}',
							`price`        = '{$price}',
							`isLaunched`   = '{$isLaunched}',
							`isNewProduct` = '{$isNewProduct}',
							`rate`         = '{$rate}'
					   WHERE `id` = '{$movie_id}'	
		";
$query = mysqli_query($_SESSION['link'], $sql);
if (!$query){
    $code = 1;
    $message = "movie insert SQL syntax error:" . "{$sql}" . ", mysqli_error:" . mysqli_error($_SESSION['link']);
    echo json_encode(array('code' => $code, 'message' => $message));
    exit;
}


if ($_POST['listOrder'] == "NULL") // NULL, 表示要下架
{
	if ($_POST['origin_listOrder'] != "NULL") // 若原本是有上架的, 要調整排序 將此item排序設為null
	{
		// 如果原本的排序為NULL(原本為下架) 加入一個排序
		$listOrderReorder_result = stop_launch_movie($movie_id, $_POST['origin_listOrder']); 
		if ($listOrderReorder_result['code'] != 0){
	        echo json_encode($listOrderReorder_result);
	        exit;
	    }
	}

	// 要下架, 且原本就是下架, 不用調整排序
}
else{
	// 要上架, 且原本為下架
	if ($_POST['origin_listOrder'] == "NULL")
	{
		// 如果原本的排序為NULL(原本為下架) 加入一個排序
		$listOrderReorder_result = add_listOrder($movie_id, $_POST['listOrder']); 
		if ($listOrderReorder_result['code'] != 0){
	        echo json_encode($listOrderReorder_result);
	        exit;
	    }
	}
	else // 要上架,原本為上架
	{
		$listOrderReorder_result = sortableMovieListOrder($movie_id,  $_POST['origin_listOrder'], $_POST['listOrder']);
		if ($listOrderReorder_result['code'] != 0){
			echo json_encode($listOrderReorder_result);
	        exit;
		}
	}
}


$code = 0;
$message = "電影-" . $chi_name ."-編輯成功!!";
echo json_encode(array('code' => $code, 'message' => $message));

?>