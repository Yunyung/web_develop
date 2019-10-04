<?php
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";

$result = Verify_userLogin($_POST['userAccount'], $_POST['userPassword']);

echo json_encode([ 'isExist' => $result ]) ;



?>	