<?php
@session_start();
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}
require_once "../DB_Setting/DB.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>後台-下架電影管理-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/business.css">
    <link rel="stylesheet" href="../css/movie.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="..\fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body>
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="my-4">
                            <h1 class="titleBg MovieListTitle">下架電影管理</h1>
                        </div>
                    </div>
                </div>
                <!-- CurrentPath  -->
                <div class="row">
                    <div class="col-sm-12" id="currentPath">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">後台首頁</a></li>
                                <li class="breadcrumb-item active" aria-current="page">下架電影</li>
                            </ol>
                        </nav>
                    </div>
                </div> <!-- /.CurrentPath -->
                <div class="row my-2">
                    <div id="searchPanel" class="col-7 col-md-6 col-lg-4">
                        <form method="GET" id="searchForm" action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="requrestCondition" id="SearchMoive" placeholder="搜尋中英電影名稱...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-blue movieBtn" style="min-width: 50px; cursor: pointer;"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- add new movie -->
                    <div class="col">
                        <a href="addNewMovie.php" class="btn btn-success movieBtn float-right" role="button"">新增商品</a>
                    </div>
                </div>

                <div class="row" id="movieItemContainer">
                    <?php 
                    // 搜尋條件
                    if (isset($_GET['requrestCondition'])){
                        $movieNameCondition = "%" . $_GET['requrestCondition'] . "%";
                    }
                    else{
                        $movieNameCondition = "%";
                    }

                    $pages = (isset($_GET["pages"])) ? $_GET["pages"] : $pages = 1;

                    $sql = "SELECT COUNT(*) as 'count' FROM `movie` WHERE `isLaunched` = 0";
                    $query = mysqli_query($_SESSION['link'], $sql);

                    if($query):
                        // 分頁製作
                        $records_per_page = 8; // 每頁呈現多少筆資料
                        $count_row = mysqli_fetch_assoc($query);
                        $total_records = $count_row['count']; // 總row數量
                        $total_pages = ceil($total_records / $records_per_page); // 總頁數
                        $offset = ($pages - 1) * $records_per_page; // row位移量
                        
                        $sql = "SELECT * FROM `movie` WHERE `isLaunched` = 0 AND (`chi_name` like '{$movieNameCondition}' OR `eng_name` like '{$movieNameCondition}') LIMIT {$offset}, {$records_per_page}";
                        $result = mysqli_query($_SESSION['link'],$sql); // 取得當前頁面要顯示的(row)資料
                        // 若無此電影
                        if (mysqli_num_rows($result) == 0){
                            echo "<p style='margin: 0 auto; font-size: 20px; color:red;'>查無電影!!<p>";
                        }
                        // 讀取每一筆資料
                        while ($row = mysqli_fetch_assoc($result)):
                                $id = $row['id'];
                                $cover_path = "../" . $row['cover_path'];
                                $isNewProdect = $row['isNewProduct'];
                                $categorys = explode(",", $row['category']);
                                $chi_name = (mb_strlen($row['chi_name'], 'utf-8') <= 7) ? $row['chi_name'] : mb_substr($row['chi_name'], 0, 7, 'utf-8') . " ...";
                                $eng_name = (strlen($row['eng_name']) <= 16) ? $row['eng_name'] : substr($row['eng_name'], 0, 16) . " ...";
                                $releaseDate = $row['releaseDate'];
                                $listOrder = $row['listOrder'];

                                $rate = $row['rate'];
                                switch($rate){
                                    case("普遍級"):
                                        $rate_class = "general-rate";
                                        $movie_rate = "普 0⁺";
                                        break;
                                    case("保護級"):
                                        $rate_class = "protect-rate";
                                        $movie_rate = "護 6⁺";
                                        break;
                                    case("輔導級"):
                                        $rate_class = "teenager-rate";
                                        $movie_rate = "輔 15⁺";
                                        break;
                                    case("限制級"):
                                        $rate_class = "Restricted-rate";
                                        $movie_rate = "限 18⁺";
                                        break;
                                    default:
                                        $rate_class = "general";
                                        $movie_rate = "普 0⁺";

                                }
                    ?>
                            <div class="col-lg-3 col-md-4 col-8 col-sm-6 mb-3 my-4 py-4 movieItem" movie-id="<?= $id ?>" id="movieItem_<?= $id ?>">
                                <div class="item-thumb">
                                    <a href="../movieDetail.php?id=<?= $id ?>">
                                        <img src="<?= $cover_path ?>" height = "320px" width="100%" alt="產品圖\">
                                    </a>
                                    <? if ($isNewProdect == 1): ?>
                                    <div class="MovieTypeArea">
                                        <h3 class="rank">新上映</h3>
                                    </div>
                                    <? endif; ?>
                                    <!-- 電影分級 -->
                                    <div class="MovieRateArea"> 
                                        <span class="px-1 <?= $rate_class ?>"><?= $movie_rate ?></span>
                                    </div> 
                                </div>
                                <section class="iconArea my-2">
                                    <?
                                        foreach (array_slice($categorys, 0, 4) as $c){
                                            echo "<span class='theaterCategory'>{$c}</span>";
                                        }
                                        if (count($categorys) > 4) echo "<span style='color: #999;'> ...</span>";
                                    ?>                           
                                </section>
                                <section class="infoArea">
                                    <h4><a href="../movieDetail.php?id=<?= $id ?>"><?= $chi_name ?></a></h4>
                                    <h5><?= (strlen($eng_name) != 0) ? $eng_name : '暫無英文名稱' ?></h5>
                                    <time><?= ($releaseDate != null) ? $releaseDate : '上映日未定' ?></time>
                                </section>  
                                <div class="btnArea" style="display:flex; flex-flow: wrap;" data-movie-id="<?= $id ?>" data-movie-name="<?= $chi_name ?>" data-movie-listOrder="<?= $listOrder ?>">
                                    <a href="javascript:void(0)" class="btn btn-orange movieBtn Launched_movie" style="flex-basis: 100%">上架電影</a>
                                    <a href="updateMovie_selectOption.php?id=<?= $id ?>" class="btn btn-primary movieBtn updateMovie" role="button"">編輯電影</a>
                                    <a href="javascript:void(0)" class="btn btn-danger movieBtn del_movie" role="button" >刪除電影</a>
                                </div>                                      
                            </div>
                            
                    <?php 
                        endwhile; // end while loop   
                    else: echo "sql error: {$sql} <br>" . mysqli_error();
                    endif;  // end if
                    ?>
                </div>

                <!--PageMark-->
                <div class="row" id="pageMark" data-records-per-page="<?= $records_per_page ?>" data-currentPage="<?= $pages ?>">
                    <div class="pageBar" >
                        <?php
                            if ( $pages > 1 )  // 顯示上一頁
                               echo "<a class='btn btn-blue movieBtn btn-lg' href='?pages=" .($pages-1). "'><<a>";
                            else
                                echo "<a class='btn btn-blue movieBtn btn-lg disabled' role='button' aria-disabled='true'><</a>";
     
                            for ( $i = 1; $i <= $total_pages; $i++ )
                               if ($i != $pages)
                                   echo "<a class='btn btn-blue movieBtn btn-lg' href='?pages=" .($i). "'>{$i}<a>";
                               else
                                   echo "<a class='btn btn-blue movieBtn btn-lg disabled' href='?pages=" .($i). "'>{$i}<a>";

                            if ( $pages < $total_pages )  // 顯示下一頁
                                echo "<a class='btn btn-blue movieBtn btn-lg' href='?pages=" .($pages+1). "'>><a>";
                            else
                                echo "<a class='btn btn-blue movieBtn btn-lg disabled' role='button' aria-disabled='true'>></a>";
                        ?>
                    </div>
                </div><!-- /.PageMark -->

                <!-- Delete alert Dialog -->
                <div id="AlertDialog" title="刪除" style="display:none;">
                    <p ><span class="ui-icon ui-icon-alert"></span>確定要刪除嗎，資料將無法再次復原!!??</p>
                </div> <!-- /.Delete alert Dialog -->
                
                <!-- Modal -->
                <div class="modal fade" id="movieModal" tabindex="-1" role="dialog" aria-labelledby="movieModal" aria-hidden="true">
                    <div class="modal-dialog movieModal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">上架電影</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modal-body">
                                <form method="POST" id="LaunchMovieForm" class="movieForm">
                                    <p id="modal-message" style="font-weight: bold;">如要上架電影, 請輸入電影欲在列表呈現的順序</p>
                                        <div class="form-group">
                                        <label for="listOrder">1.電影於列表呈現的序列</label>
                                        <small class="movieAzureAlert listOrderNote"></small><br>
                                        <select class="custom-select col-sm-6" name="listOrder">
                                        </select>
                                        <small class="form-text text-muted">※ 電影顯示在列表中的位置，若未輸入，預設新增後顯示再第一位, 可再自行更改編輯</small>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary movieBtn" data-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-success movieBtn" id="btn-ModalConfirm">確定</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.Container -->
        </div><!-- /.contentBanner -->
        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div><!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="../jquery/jquery-ui-1.12.1/jquery-ui.min.css">
    <script src="../jquery/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <!-- toastrJS -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/commonUse.js"></script>
    <script>
    $(function() {
        var movie_chi_name;
        var fade_movie;
        $("a.del_movie").on("click", function(){
            var del_movie_id = $(this).parent().attr("data-movie-id");
            movie_chi_name = $(this).parent().attr("data-movie-name");
            fade_movie = $(this).parent().parent();
            console.log("del_movie_id:" + del_movie_id);
            $("#AlertDialog").dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "刪除": function() {
                        $.ajax({
                                method: "POST", // 傳遞表單的方式
                                url: "../phpfunction/ajax_del_movie.php", // 目標給哪個檔案
                                data: { // 傳送的資料 ，使用物件的方式傳送，
                                    movie_id: del_movie_id
                                },
                                dataType: 'json' // 設定該網站回應的格式
                            })
                            .done(function(data) {
                                // 檢查是否與資料庫資料存在
                                if (data['code'] == 0) {
                                    fade_movie.fadeOut("slow", function(){
                                        // 淡出並且移除, fadeOut僅隱藏，並無移除，不移除僅隱藏會影響到sort
                                        $(this).remove();
                                    }); 
                                    toastr.success(data['message'], "成功刪除電影:" + movie_chi_name);
                                } else {
                                    toastr.error('刪除失敗!!');
                                    console.log("刪除失敗!!" + data);
                                }
                                console.log(data);
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                // 失敗的時候 ex: 404, ...
                                toastr.error('fail!!');
                                console.log(jqXHR.responseText);
                            });
                        $(this).dialog("close");
                    },
                    "取消": function() {
                        $(this).dialog("close");
                    }
                }
            });
        });

        var launch_movie_id;
        $("a.Launched_movie").on("click", function(){
            launch_movie_id = $(this).parent().attr("data-movie-id");
            movie_chi_name = $(this).parent().attr("data-movie-name");
            fade_movie = $(this).parent().parent();
            $.post('../phpfunction/getSomeMovieInfo.php', function(data){
                // console.log(data);
                var max_listOrder = data['movie_data']['listOrder'];
                console.log(max_listOrder);
                $('select[name="listOrder"]').empty();
                $("small.listOrderNote").empty();
                $("small.listOrderNote").append("<span class='movieRedAlert'><i class='fas fa-bell ' ></i>若此電影無上架,則無此欄位</span> <i class='fas fa-bell listOrderNote' >目前列表位置 0~" + max_listOrder + "，位置'首位'的電影將放在'首頁的強檔推薦'</i>");

                
                    $('select[name="listOrder"]').append("<option value='" + 0 + "'>首位</option>");
                    for (var i = 1;i <= max_listOrder;i++)
                    {
                        $('select[name="listOrder"]').append("<option value='" + i + "'>" + i + "</option>");
                    }
                if (max_listOrder != null)
                {
                    $('select[name="listOrder"]').append("<option value='" + (max_listOrder*1 + 1) + "'>" + "放最後" + "</option>");
                }
                    
                $("#DialogMessage").html('確定要上架嗎?');
                $('#movieModal').modal();
            }, 'json');
        });

        $('.modal-footer #btn-ModalConfirm').on('click', function(){

            $("#movieModal").modal('hide');
            $.ajax({
                    method: "POST", // 傳遞表單的方式
                    url: "../phpfunction/ajax_changeLaunchState_admin.php", // 目標給哪個檔案
                    data: { // 傳送的資料 ，使用物件的方式傳送，
                        id : launch_movie_id,
                        listOrder : $('select[name="listOrder"] option:selected').val(),
                        oper : "launch"
                    },
                    dataType: 'json' // 設定該網站回應的格式
                })
                .done(function(data) {
                    // 檢查是否與資料庫資料存在
                    if (data['code'] == 0) {
                        toastr.success("上架電影-" + movie_chi_name + "-成功!!", "上架電影");
                        fade_movie.fadeOut("slow", function(){
                            // 淡出並且移除
                            $(this).remove();
                        }); 

                    } else {
                        toastr.error("上架電影失敗, 錯誤代碼:" + data['code'], "上架電影");
                    }

                    console.log(data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    // 失敗的時候 ex: 404, ...
                    alert("有錯誤發生，請查看錯誤訊息")
                    console.log(jqXHR.responseText);
                });
        });

        $('input#SearchMoive').autocomplete({
            source: "../phpfunction/autoCompleteSearch.php",
            minLength: 1    
        });
    });
    </script>
</body>

</html>