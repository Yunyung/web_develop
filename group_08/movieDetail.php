<?
    @session_start();
    require_once "DB_Setting/DB.php";

    $sql = "select * from movie where id =". $_GET['id'];
    if($result = mysqli_query($_SESSION['link'],$sql)){
        $row = mysqli_fetch_assoc($result);
    }
    $chi_name     = $row['chi_name'];
    $actors       = explode(',', $row['actors']);
    $directors    = explode(',', $row['directors']);
    $categorys    = explode(',', $row['category']);
    $cover_path   = $row['cover_path'];
    $releaseDate  = ($row['releaseDate'] != null) ? $row['releaseDate'] : "未定";
    $Length_cut   = ($row['Length'] != null) ? explode(':', $row['Length']) : "未定";
    $Length       = $Length_cut[1] . "時" . $Length_cut[2] . "分";
    $price        = $row['price'];
    $introduce    = $row['introduce'];
    $trailer_path = $row['trailer_path'];
    $rate         = $row['rate'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title><?= $chi_name ?>-彰師戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/business.css">
    <link rel="stylesheet" href="css/movie.css">
    <!-- slick css-->
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
    <style>
        .function_btnArea{
            display: flex;
        }
        .function_btnArea > button{
            font-size: 1.8rem;
            flex: 1;
            max-width: 35%;
            margin-left: 3px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php'; ?>
        <!--  用來留出header及footer區塊的空間  -->
        <div id="contentBanner">
            <!-- Page Content -->
            <div class="container">
                <!-- Row Page-->
                <div class="row my-4">
                    <div class="col-lg-7 px-3 py-3 mt-2">
                        <?  if ($trailer_path != null): ?>
                        <iframe width="100%" height="450" src='<?= $trailer_path?>?autoplay=1' frameborder="0" allow="autoplay;" allowfullscreen ></iframe>
                        <? 
                            else: echo "<p class='movieAlizarinCrimsonAlert' style='font-size: 2rem;'>暫無預告片</p>"; 
                            endif;
                        ?>
                    </div>
                    <div class="col-lg-5 mt-4 micro_black">
                        <table class="table table-hover">
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
                                <th>價格</th>
                                <th>NT$<?= $price ?></th>
                            </tr>
                            <tr>
                                <th>上映日期</th>
                                <th><?= $releaseDate ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
                <!--end row 1-->

                <!--確認是否已加入購物車-->
                <?php
                    $CartState = "";
                    if ($is_Login)
                    {
                        $sql = "SELECT * FROM cart where movieID ='".$_GET['id']."'and userAccount='" . $_SESSION['userAccount']."'";
                        $query = mysqli_query($_SESSION['link'], $sql);
                        $isExistInCart = mysqli_num_rows($query);
                        if($isExistInCart && $is_Login)
                        {
                            $row = mysqli_fetch_assoc($query);
                            $CartState = $row['state'];
                        }
                    }
                ?>
                <!-- functional button -->
                <div class="mb-3 function_btnArea">
                    <!-- 播放影片按鈕 -->
                    <?  $isDisabled = ($CartState == "已結帳") ? "" : "hidden disabled" ?>
                    <button class="btn btn-info movieBtn play_movie" id="play_movie" <?= $isDisabled ?> ><i class="far fa-play-circle"></i> 開始播放</button>

                    <!-- 加入購物車按鈕 -->
                    <? if ($CartState != "待付款" && $CartState != "已結帳"): ?>
                    <button class="btn btn-success movieBtn " id="addcart"><i class="fas fa-shopping-cart"></i> 加入購物車</button>
                    <? else: ?>
                    <button class="btn btn-success movieBtn " id="addcart"  disabled><i class="fas fa-shopping-cart"></i> 已加入購物車</button>
                    <? endif; ?>

                    <!-- 直接購買按鈕 -->
                    <? if ($CartState != "已結帳"): ?>
                    <button class="btn btn-pink movieBtn buy_btn float-right" data-toggle="modal" data-target="#movieModal"><i class="fas fa-money-check-alt"> 直接購買 $<?= $price ?></i></button>
                    <? else: ?>
                    <button class="btn btn-pink movieBtn buy_btn float-right" data-toggle="modal" data-target="movieModal" disabled><i class="fas fa-money-check-alt"> 已結帳</i></button>
                    <? endif; ?>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="movieModal" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel" aria-hidden="true" >
                  <div class="modal-dialog movieModal-dialog" role="document" >
                    <div class="modal-content" >
                      <div class="modal-header">
                        <h5 class="modal-title" id="movie-modal-title" >直接購買</h5>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                       <div class="modal-body" id="modal-body">
                            <p id="movie-modal-message">此電影價格為$<?= $price ?>元, 確定要直接購買, 立即付款嗎?</p>
                       </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary movieBtn" data-dismiss="modal">關閉</button>
                        <button type="button" class="btn btn-primary movieBtn" data-dismiss="modal" id="buy">確定</button>
                      </div>
                    </div>
                  </div>
                </div> <!-- /. Modal -->

                <!--picture and introduce-->
                <div class="row">
                    <div class="col-lg-3 mb-3">
                        <img src="<?= $cover_path ?>" width="100%" height="350px">
                    </div>
                    <div class="introduce col-lg-8 mb-3 ml-2 micro_black ">
                        <h1 style=""><?= $chi_name; ?></h1>
                        <div style="font-size: 1.2em;">
                            &nbsp &nbsp &nbsp&nbsp
                            <?= $introduce ?>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3>精采劇照</h3>
                    <ul class="slick11 mt-4">
                    <?php 
                        // 找到所有劇照位置
                        $sql = "select * from moviestills where id =" . $_GET['id'];
                        if($result = mysqli_query($_SESSION['link'],$sql)){
                            $total_num = mysqli_num_rows($result);
                            //  顯示所有劇照
                            for($i = 0; $i < $total_num; $i++){
                                 $row = mysqli_fetch_assoc($result);
                                 echo  "<li><img src='{$row['still_path']}' width='90%' height='160' ></li>";
                            }
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
        <input type="hidden" id = "movieID" value="<?=$_GET['id']; ?>">
        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div>
    <!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- toastrJS -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Custom JS -->
    <script src="js/commonUse.js"></script>
    <script src="slick/slick.js"></script>
    <script>
    $(document).ready(function() {});
    $(".slick11").slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        // autoplay: true,
        arrow: true,

        autoplaySpeed: 3000,
        responsive: [{
                breakpoint: 1300,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 770,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('#addcart').click(function(){
        $.ajax({
            method:"POST",
            url:"phpfunction/ajax_AddToCart.php",
            data: { // 傳送的資料 ，使用物件的方式傳送，
                   movieID: $("#movieID").val(),
                },
                dataType: 'json' // 設定該網站回應的格式
        })
        .done(function(data) {
            // 檢查是否與資料庫資料存在
            if (data['is_Login'] == false)
            {
                window.location.href="memberLogin.php";
            }
            else if (data['isSuccess'] == true) {
                $('#addcart').html("<i class='fas fa-shopping-cart'></i> 已加入購物車");
                $('#addcart').prop("disabled",true);
                toastr.success("成功加入購物車!");
                console.log(data);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            // 失敗的時候 ex: 404, ...
            console.log(jqXHR.responseText);
        });
    });

    $('#buy').click(function(){
         $.ajax({
                method: "POST", // 傳遞表單的方式
                url: "phpfunction/ajax_cart_buy.php", // 目標給哪個檔案
                data: { // 傳送的資料 ，使用物件的方式傳送，
                    movieID:$("#movieID").val(),
                },
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['is_Login'] == false)
                {
                    window.location.href="memberLogin.php";
                } 
                else if (data['isSuccess'] == true) {

                    $('.buy_btn').html('<i class="fas fa-money-check-alt"></i> 已購買');
                    $('.buy_btn').prop("disabled",true);
                    $('#addcart').prop("disabled",true);
                    $('#play_movie').removeAttr("disabled");
                    alert("結帳成功!!");

                    console.log(data);
                    $('#play_movie').prop("hidden", false);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // 失敗的時候 ex: 404, ...
                return true;
            });
    });

    $('.play_movie').click(function(){
        window.location.href="play_movie.php?id="+$("#movieID").val();
    });

    </script>
</body>

</html>