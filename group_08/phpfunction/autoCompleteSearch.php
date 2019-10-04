<?php
@session_start();
require_once '../DB_Setting/DB.php';

$term = trim(strip_tags($_GET['term']));//固定以term傳送查詢條件
$sql = "SELECT `chi_name`, `eng_name` FROM `movie` WHERE `chi_name` like '%$term%' OR `eng_name` like '%$term%'"; //預設的變數名稱是term

if ( $result = mysqli_query($_SESSION['link'], $sql) ) { 
  while( $row = mysqli_fetch_assoc($result) ){
  	// 若找到的是中文符合
  	if (strpos($row['chi_name'], $term) !== false){
  		$name[] = $row["chi_name"]; //將資料存入陣列
  	} 
    else{
    	$name[] = $row["eng_name"];
    }

  } 
  mysqli_free_result($result); // 釋放佔用的記憶體 
} 
echo json_encode($name); //回傳JSON格式資料
?>	