<?
    @session_start();
    require_once "DB_Setting/DB.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>電影列表-彰師戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/business.css">
    <link rel="stylesheet" href="css/movie.css">
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body>
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <div class="container">
                <div class="row">
                    <div class="my-4">
                        <h1 class="MovieListTitle micro_black">上映電影</h1>
                    </div>
                </div>
                <div class="row">
                    <div id="searchPanel" class="col-7 col-md-6 col-lg-5">
                        <form method="GET" id="searchForm" action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="requrestCondition" id="SearchMoive" placeholder="搜尋中英電影名稱...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-orange movieBtn" style="min-width: 50px; cursor: pointer;"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        // 搜尋條件
                        if (isset($_GET['requrestCondition'])){
                            $movieNameCondition = "%" . $_GET['requrestCondition'] . "%";
                        }
                        else{
                            $movieNameCondition = "%";
                        }

                        if (isset($_GET["pages"])) $pages = $_GET["pages"]; else $pages = 1;

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

                            if (mysqli_num_rows($result) == 0){
                                echo "<p style='margin: 0 auto; font-size: 20px; color:red;'>查無此電影!!<p>";
                            }
                            // 讀取每一筆資料
                            while ($row = mysqli_fetch_assoc($result)):
                                $id = $row['id'];
                                $cover_path = $row['cover_path'];
                                $isNewProdect = $row['isNewProduct'];
                                $categorys = explode(",", $row['category']);
                                $chi_name = $row['chi_name'];
                                $eng_name = $row['eng_name'];
                                $releaseDate = $row['releaseDate'];

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
                            <div class="col-lg-3 col-md-4 col-8 col-sm-6 mb-3 my-4 py-4 movieItem movieItem">
                                <div class="item-thumb">
                                    <a href="movieDetail.php?id=<?= $id ?>">
                                        <img src="<?= $cover_path ?>" width="100%" height = "320px" alt="產品圖\">
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
                                        foreach ($categorys as $c){
                                            echo "<span class='theaterCategory'>{$c}</span>";
                                        }
                                    ?>                           
                                </section>
                                <section class="infoArea">
                                    <h4><a href="movieDetail.php?id=<?= $id ?>"><?= $chi_name ?></a></h4>
                                    <h5><?= (strlen($eng_name) != 0) ? $eng_name : '暫無英文名稱' ?></h5>
                                    <time><?= ($releaseDate != null) ? $releaseDate : '上映日未定' ?></time>
                                </section>                            
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
            </div>
        </div> <!-- /.contentBanner -->
        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div><!-- /.wrapper -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="jquery/jquery-ui-1.12.1/jquery-ui.min.css">
    <script src="jquery/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <!-- Custom JS -->
    <script src="js/commonUse.js"></script>
    <script>
        $('input#SearchMoive').autocomplete({
            source: "phpfunction/autoCompleteSearch.php",
            minLength: 1    
        });
    </script>
</body>

</html>