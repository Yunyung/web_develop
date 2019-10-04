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
    <title>後台-上映電影管理-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/business.css">
    <link rel="stylesheet" href="../css/movie.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="..\fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
    <style >
        .movieItem{
            -webkit-transition: all 50ms ease-out;
        }
    </style>
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
                            <h1 class="titleBg MovieListTitle">上映電影管理</h1>
                        </div>
                    </div>
                </div>
                <!-- CurrentPath  -->
                <div class="row">
                    <div class="col-sm-12" id="currentPath">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">後台首頁</a></li>
                                <li class="breadcrumb-item active" aria-current="page">上映電影</li>
                            </ol>
                        </nav>
                    </div>
                </div> <!-- /.CurrentPath -->
                <div class="row my-2">
                    <div id="searchPanel" class="col-7 col-md-6 col-lg-4">
                        <form method="GET" id="searchForm" action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="SearchMoive"name="requrestCondition" placeholder="搜尋中英電影名稱...">
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

                    $sql = "SELECT COUNT(*) as 'count' FROM `movie` WHERE `isLaunched` = 1";
                    $query = mysqli_query($_SESSION['link'], $sql);

                    if($query):
                        // 分頁製作
                        $records_per_page = 8; // 每頁呈現多少筆資料
                        $count_row = mysqli_fetch_assoc($query);
                        $total_records = $count_row['count']; // 總row數量
                        $total_pages = ceil($total_records / $records_per_page); // 總頁數
                        $offset = ($pages - 1) * $records_per_page; // row位移量
                        
                        $sql = "SELECT * FROM `movie` WHERE `isLaunched` = 1 AND (`chi_name` like '{$movieNameCondition}' OR `eng_name` like '{$movieNameCondition}') ORDER BY `listOrder` ASC  LIMIT {$offset}, {$records_per_page}";
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
                                <div class="btnArea" style="display:flex" data-movie-id="<?= $id ?>" data-movie-name="<?= $chi_name ?>" data-movie-listOrder="<?= $listOrder ?>">
                                    <a href="updateMovie_selectOption.php?id=<?= $id ?>" class="btn btn-primary movieBtn updateMovie" role="button"">編輯</a>
                                    <a href="javascript:void(0)" class="btn btn-danger movieBtn stop_launch" role="button" >下架</a>
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
                    <p><span class="ui-icon ui-icon-alert"></span>確定要下架嗎，下架後依然可再次上架!!??</p>
                </div> <!-- /.Delete alert Dialog -->
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
        $("a.stop_launch").on("click", function(){

            var stop_launch_id = $(this).parent().attr("data-movie-id");
            var movie_chi_name = $(this).parent().attr("data-movie-name");
            var movie_listOrder = $(this).parent().attr("data-movie-listOrder");
            var fade_movie = $(this).parent().parent();
            console.log("stop_launch_id:" + stop_launch_id);
            $("#AlertDialog").dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "下架": function() {
                        $.ajax({
                                method: "POST", // 傳遞表單的方式
                                url: "../phpfunction/ajax_changeLaunchState_admin.php", // 目標給哪個檔案
                                data: { // 傳送的資料 ，使用物件的方式傳送，
                                    id: stop_launch_id,
                                    listOrder: movie_listOrder,
                                    oper : "stop_launch"
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
                                    toastr.success("成功下架電影:" + movie_chi_name);

                                    // 刪除後則將特定的電影listOrder屬性改變 
                                    $('div.btnArea').each(function(){   
                                        var lo = $(this).attr('data-movie-listOrder');
                                        if (lo > movie_listOrder){
                                            $(this).attr('data-movie-listOrder', lo - 1);
                                        }
                                    });
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

        // jquery ui sortable 以拖拉方式改變呈現順序，同時存入資料庫
        $("#movieItemContainer").sortable({
            start: function(event, ui) {
                $(this).attr('data-previndex', ui.item.index());
                // or ui.item.data('previndex');
                $(this).attr('movie-id', ui.item.attr('movie-id'));
            },
            update: function(event, ui) {
                var data = $(this).sortable('serialize');

                var pageOffsetIndex = $('#pageMark').attr('data-records-per-page') * ($('#pageMark').attr('data-currentPage') - 1);
                console.log(pageOffsetIndex);
                var movie_id = $(this).attr('movie-id');
                var newIndex = ui.item.index() + pageOffsetIndex;
                var oldIndex = parseInt($(this).attr('data-previndex')) + pageOffsetIndex;

                
                console.log(oldIndex + "," + newIndex);

                // POST to server using $.post or $.ajax
                console.log(data);
                $.ajax({
                    method: "POST", 
                    url: "../phpfunction/ajax_sortableMovieListOrder.php", // 目標給哪個檔案
                    data: {
                        movie_id : movie_id,
                        ItemOldIndex : oldIndex,
                        ItemNewIndex : newIndex
                    },
                    success: function(){
                        // 改變attr 這樣刪除時才會正確
                        setlistAttrAftersort(movie_id, oldIndex, newIndex)
                    }
                    
                });
            }
        });

        function setlistAttrAftersort(movie_id, ItemOldIndex, ItemNewIndex){
            if (ItemOldIndex < ItemNewIndex){
                // 受牽連的item attr皆向前移動1格
                $('div.btnArea').each(function(){   
                    var lo = $(this).attr('data-movie-listOrder');
                    if (lo <= ItemNewIndex && lo > ItemOldIndex){
                        $(this).attr('data-movie-listOrder', lo - 1);
                    }
                });
                $('#movieItem_' + movie_id).attr('data-movie-listOrder', ItemNewIndex);
            }
            else if (ItemOldIndex > ItemNewIndex){
                $('div.btnArea').each(function(){   
                    var lo = $(this).attr('data-movie-listOrder');
                    if (lo >= ItemNewIndex && lo < ItemOldIndex){
                        $(this).attr('data-movie-listOrder', lo * 1 + 1);
                    }
                });
                $('#movieItem_' + movie_id).attr('data-movie-listOrder', ItemNewIndex);

                
            }
        }

        $('input#SearchMoive').autocomplete({
            source: "../phpfunction/autoCompleteSearch.php",
            minLength: 1    
        });
    });
    </script>
</body>

</html>