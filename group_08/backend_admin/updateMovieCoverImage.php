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
    <title>後台-編輯電影封面-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap4 core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/business.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="../fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
    <style>
    .cover-img {
        height: 306px;
        margin-top: 20px;
        max-width: 100%;
    }
    
    

    </style>
</head>

<body class="movieBg">
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <div class="container">
                <div class="row">
                    <!-- Title-->
                    <div class="col-sm-12">
                        <div class="my-4">
                            <h1 class="titleBg" style="color: #c33;">電影編輯選擇</h1>
                        </div>
                    </div>
                    <!-- /.Title-->
                    <div class="col-sm-12" id="currentPath" style="padding: 0;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">後台首頁</a></li>
                                <li class="breadcrumb-item"><a href="movieList.php">電影管理</a></li>
                                <li class="breadcrumb-item"><a href="updateMovie_selectOption.php">編輯項目選擇</a></li>
                                <li class="breadcrumb-item active" aria-current="page">編輯封面</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="movieFormPanel mt-2 col-10 col-md-8" style="padding:0;">
                        <div class="Panel-heading">
                            <div class="Panel-Title">
                                編輯電影封面
                            </div>
                        </div>
                        <form method="POST" id="updateCoverImageFrom" class="movieForm" style="padding: 10px 25px; " action="../phpfunction/updateCoverImage_admin.php" enctype="multipart/form-data">
                            <? 
                                $id = $_GET['id'];
                                $sql = "SELECT `cover_path` FROM `movie` WHERE `id` = '{$id}'";
                                $query = mysqli_query($_SESSION['link'], $sql);
                                $row = mysqli_fetch_assoc($query);
                                $cover_path = $row['cover_path'];
                            ?>
                            <input type="hidden" id="movie_id"name="id" value="<?= $id ?>">
                            <input type="hidden" name="old_cover_path" value="<?= $cover_path ?>">
                            <div class="row">
                                <div class="form-group col-12 col-lg-6" >
                                    <label for="old-cover-img" style="font-weight: bold">原本的封面圖片：</label><br>
                                    <img id="old-cover-img" class="cover-img" src="../<?= $cover_path ?>">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="new-cover-img" style="font-weight: bold">上傳新封面圖片：</label>
                                    <div id="new-cover-image-holder"></div>
                                    <input type="file" class="form-control-file mt-1" id="new-cover-img" name="new-cover-img" accept="image/png, image/jpeg">
                                    <small class="form-text text-muted">※ 封面圖片格式(png,jpg),解析度請上傳'寬 <
                                    長'的圖片,9:16佳</small>
                                </div>
                            </div>
                            <div class="FormErrorMessageArea">
                                <div id="ErrorMessage"></div>
                            </div>
                            <div class="btnArea">
                                <button type="submit" class="btn btn-success movieBtn">確定</button>
                            </div>
                        </form> <!-- /.form -->
                        <!-- 成功註冊後 轉跳倒數的div 初始為隱藏-->
                        <div class="SuccessBlock">
                            <div class="loading"></div>
                            <div class="redirectMessage"></div>
                        </div>
                    </div> <!-- /.formPanel -->
                </div><!-- /.row -->
            </div><!-- container -->
        </div><!-- /.contentBanner -->
        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div>
    <!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- toastr.js -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/commonUse.js"></script>
    <script>
        $("div#new-cover-image-holder").hide(); // 初始隱藏用來顯示圖片的div
        // 封面input改變時
        $("#new-cover-img").on('change', function() {
            console.log($(this)); // 可查看此input
            var img_file = this.files[0]; // 取得img 

            var fileType = img_file["type"]; // 檢查此檔案的Type是否符合格式
            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"]; // 符合的格式

            var image_holder = $("#new-cover-image-holder"); // 取得暫存照片的div
            image_holder.empty();

            if ($.inArray(fileType, ValidImageTypes) >= 0) {
                // 檢查是否為照片指定格式   ($.inArray -> 不存在回傳-1, 存在則回傳位置)


                var reader = new FileReader();
                reader.onload = function(e) { // 照片load完成之後 將照片放入顯示圖片的div()
                    $("<img />", {
                        "src": e.target.result,
                        "class": "cover-img"
                    }).appendTo(image_holder);
                }
                $("#new-cover-image-holder").show();
                reader.readAsDataURL(img_file);
            } else {
                toastr.error("請上傳正確照片格式(png, jpg)，否則無法正常預覽", "上傳格式錯誤");
            }
        });

        /*
         *  form 檢查
         */
            $("#updateCoverImageFrom").submit(function(){
                if ($('#new-cover-img')[0].files.length == 0){
                    $("#ErrorMessage").html("請選擇封面圖片!!");
                    $('#new-cover-img').focus();
                    toastr.error($("#ErrorMessage").html());
                    return false;
                }

                if ($('#new-cover-image-holder').has('img').length == 0){
                    $("#ErrorMessage").html("封面檔案格式錯誤!!");
                    $('#new-cover-img').focus();
                    toastr.error($("#ErrorMessage").html());
                    return false;
                }

                var form_data = new FormData(this);
                $.ajax({
                        method: "POST", // 傳遞表單的方式
                        url: "../phpfunction/updateCoverImage_admin.php", // 目標給哪個檔案
                        data: form_data,
                        processData: false,
                        contentType: false,
                        dataType: 'json' // 設定該網站回應的格式
                    })
                    .done(function(data) {
                        // 檢查是否與資料庫資料存在
                        if (data['code'] == 0){
                            $("form#updateCoverImageFrom").hide();
                            $(".movieFormPanel").css("min-width", "auto");
                            $(".SuccessBlock").show();
                            $(".loading").html("<i class='fas fa-spinner fa-pulse'></i>");
                            $(".redirectMessage").html("<span style='color: orange;'>更換封面成功!!</span>，<span id='countDown'>5</span> 秒後後更新並重新載入畫面");
                            // 倒數計時跳轉頁面
                            var count = 5;
                            setInterval(function(){
                                count--;
                                $("#countDown").html(count);
                                if (count == 0){
                                    window.location.href="updateMovieCoverImage.php?id=" + $('#movie_id').val();
                                }
                            }, 1000);
                            toastr.success(data['message'], "封面更新");
                            // window.location.href="memberLogin.php";
                        }
                        else{
                            toastr.error(data['message'] , "錯誤代碼:" + data['code']);
                            console.log("code:" + data['code'] + ",message:" + data['message']);
                        }

                        // header( "refresh:5;url=index.php" ); 
                        // echo 'You\'ll be redirected in about 5 secs. If not, click <a href="wherever.php">here</a>.'; 

                        console.log(data);
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        // 失敗的時候 ex: 404, ...
                        alert("有錯誤發生，請看console log")
                        console.log(jqXHR.responseText);
                    });

                return false;
            });
    </script>
</body>

</html>