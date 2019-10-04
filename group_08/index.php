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
    <title>彰師大戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/business.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body>
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php'; ?>
        <!--  用來留出header及footer區塊的空間  -->
        <div id="contentBanner"> 
            <!-- Carousel ==================================================== -->
            <div class="slider-area">
                <div id="carousel-slide" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <? 
                        $sql = "SELECT * FROM `movieslider`";
                        $query = mysqli_query($_SESSION['link'], $sql);
                        if ($query):
                            $total_records = mysqli_num_rows($query);
                            for ($i = 0;$i < $total_records;$i++): 
                        ?>

                        <li data-target="#carousel-slide" data-slide-to="<?= $i ?>" class="
                        <?= ($i == 0)?'active':'';?> "></li>
                        
                        <?  endfor; ?>
                    </ol> <!-- /.carousel-indicators -->
                    <div class="carousel-inner">
                        <?  
                            $first = true;
                            while ($row = mysqli_fetch_assoc($query)): 
                                $slider_path = $row['slider_path'];
                                $slider_link = $row['slider_link'];
                        ?>
                        <div class="carousel-item <?= ($first == true) ? 'active' : ''; ?> ">
                            <a href="<?= $slider_link ?>">
                                <img class="d-block w-100" src="<?= $slider_path ?>" alt="slider">
                            </a>
                        </div>
                        <?  
                            $first = false;
                            endwhile; 
                        ?>
                    </div> <!-- carousel-inner -->
                        <?
                        else:  // query fail
                            echo "sql error: {$sql} <br>" . mysqli_error($_SESSION['link']);
                        endif; // end if
                        ?>
                    <a class="carousel-control-prev" href="#carousel-slide" role="button" data-slide="prev">
                        <i class="fas fa-chevron-circle-left fa-3x slider-arrow"></i>
                        <span class= "sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-slide" role="button" data-slide="next">
                        <i class="fas fa-chevron-circle-right fa-3x slider-arrow"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div> <!-- /.Carousel -->
            <!-- productRecommend -->
            <div class="productsRecommend">
                <div class="container">
                    <div class="row">
                        <!-- Title -->
                        <div class="productsRecommendTitle col-sm-12">
                            <h1>強檔推薦</h1>
                        </div>
                        <?
                            // 預設載入listOrder的第一筆來推薦
                            $sql = "SELECT * FROM `movie` WHERE `listOrder` = (SELECT MIN(`listOrder`) FROM `movie`)";
                            $query = mysqli_query($_SESSION['link'], $sql);
                            if (!$query){
                                echo "sql error: {$sql} <br>" . mysqli_error($_SESSION['link']);
                            }

                            $row = mysqli_fetch_assoc($query);
                            $id = $row['id'];
                            $cover_path = $row['cover_path'];
                            $actors = explode(',', $row['actors']);
                            $directors = explode(',', $row['directors']);
                            $categorys = explode(',', $row['category']);
                            $rate = $row['rate'];
                            $Length_cut   = ($row['Length'] != null) ? explode(':', $row['Length']) : "未定";
                            $Length       = $Length_cut[1] . "時" . $Length_cut[2] . "分";
                            $releaseDate  = ($row['releaseDate'] != null) ? $row['releaseDate'] : "未定";
                        ?>
                        <div class="col-sm-12 col-md-6">
                            <div class="HotMovie"><a href="movieDetail.php?id=<?= $id; ?>"><img src="<?= $cover_path; ?>" alt="產品圖"></a></div>
                            <div class="HotMovieRankArea">
                                <h4 class="rank">NO.1</h4>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="row">
                                <div class="col-12 ">
                                    <h2 class="HotMovieTitle"><?= $row['chi_name']; ?></h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['introduce']; ?>
                                </div>
                                <div class="col-12 mt-5">
                                    <h2 class="HotMovieTitle">Movie INFO</h2>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>演員</th>
                                            <th>
                                            <?
                                                foreach ($actors as $a){
                                                    echo $a . "<br>";
                                                }
                                            ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>導演</th>
                                            <th>
                                            <?
                                                foreach ($directors as $d){
                                                    echo $d . "<br>";
                                                }
                                            ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>類型</th>
                                            <th>
                                            <?
                                                foreach ($categorys as $c){
                                                    echo $c . " ";
                                                }
                                            ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>分級</th>
                                            <th>
                                                <? echo $rate; ?>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>影片長度</th>
                                            <th><?= $Length ?></th>
                                        </tr>
                                        <tr>
                                            <th>上映日期</th>
                                            <th><?= $releaseDate ?></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg_wave"></div>
            <!-- /.productRecommend -->
            <!-- news ===================================== -->
            <div class="news">
                <div class="container">
                    <div class="row">
                        <div class="newsTitle">
                            <h1>最新上映</h1>
                        </div>
                        <div class="news-list">
                            <div class="row">
                                <?
                                    $sql = "SELECT * FROM `movie` WHERE `isNewProduct` = 1 AND `isLaunched` = 1";
                                    $query = mysqli_query($_SESSION['link'], $sql);
                                    if ($query):
                                        while ($row = mysqli_fetch_assoc($query)):
                                            $id = $row['id'];
                                            $chi_name = $row['chi_name'];
                                            $cover_path = $row['cover_path'];
                                    

                                ?>
                                <div class="newsItem col-lg-3 col-md-4 col-sm-6">
                                    <div class="item-thumb">
                                        <a href="movieDetail.php?id=<?= $id; ?>"><img src="<?= $cover_path; ?>" alt="產品圖" style="width: 100%"></a>
                                        <div class="txt-info">
                                            <a href="movieDetail.php?id=<?= $id; ?>">
                                                <div>詳情>></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="newsItemTitle"><a href="movieDetail.php?id=<?= $id; ?>"><?= $chi_name ?></a></div>
                                </div>
                                <?
                                        endwhile;
                                    else:
                                        echo "sql error: {$sql} <br>" . mysqli_error();
                                    endif;
                                ?>
                            
                            </div>
                        </div>
                    </div> <!-- /.news-list -->
                </div>
            </div> <!-- /.nes -->
            
        </div> <!-- /.contentBanner -->
        <!-- /.news -->
        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div> <!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/commonUse.js"></script>
</body>

</html>