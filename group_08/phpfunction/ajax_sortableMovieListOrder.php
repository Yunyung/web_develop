<?
@session_start();
require_once '../DB_Setting/DB.php';
require_once "dbOperation_Functions.php";

$result = sortableMovieListOrder($_POST['movie_id'], $_POST['ItemOldIndex'], $_POST['ItemNewIndex']);


?>