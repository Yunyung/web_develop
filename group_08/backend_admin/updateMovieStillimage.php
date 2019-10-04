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
    <title>後台-編輯電影劇照-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap4 core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/business.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="../fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
    <style>
    .still-img {
        display: inline-block;
        margin-right: 10px;
        height: 160px;
        width: 50%;
        min-width: 180px;
        margin-top: 20px;
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
                                <li class="breadcrumb-item active" aria-current="page">編輯劇照</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="movieFormPanel mt-2 col-10 col-lg-6 col-md-8" style="padding:0;">
                        <div class="Panel-heading">
                            <div class="Panel-Title">
                                編輯電影劇照
                            </div>
                        </div>
                        <form method="POST" id="updateStillimageFrom" class="movieForm" action="../phpfunction/updateStillimage_admin.php" enctype="multipart/form-data">
                            <div class="form-group old_still_image_group">
                                <label for="old_still_image">1.刪除已存在的劇照</label><br>
                            <? 
                                $id = $_GET['id'];
                                $sql = "SELECT `still_path` FROM `moviestills` WHERE `id` = '{$id}'";
                                $query = mysqli_query($_SESSION['link'], $sql);
                            if (mysqli_num_rows($query) == 0):
                                echo "<p class='movieRedAlert movieAzureAlert'><i class='fas fa-bell'></i>尚未有劇照</p>";
                            else:
                                while ($row = mysqli_fetch_assoc($query)):  
                                    $still_path = $row['still_path'];
                            ?> 
                                <div class="img-group col-12">
                                    <img class="still-img" src="../<?= $still_path ?>">
                                    <button class="btn btn-danger movieBtn del_old_still_img" data-old-still-path="<?= $still_path ?>">X</button>
                                </div>
                            <? 
                                endwhile;
                            endif;
                            ?>
                            </div>
                            <div class="form-group new_still_image_group">
                                <label for="new_still_image">2.新增新劇照</label><br>
                                <input type="file" name="still_image[]" id="still_image" multiple accept="image/png, image/jpeg">
                                <div id="still_image-holder"></div>  
                                <small class="form-text text-muted">※ 可已框拉方式多則多張照片(png,jpg)，上傳照片解析度請上傳'寬>
                                長'的圖片,16:9佳</small>
                            </div>

                            <div class="FormErrorMessageArea">
                                <div id="ErrorMessage"></div>
                            </div>
                            <div class="btnArea">
                                <button type="submit" class="btn btn-success movieBtn">上傳新加入的劇照</button>
                            </div>
                            <input type="hidden" id="movie_id" name="movie_id" value="<?= $id ?>">
                        </form> <!-- /.form -->
                        <!-- 成功註冊後 轉跳倒數的div 初始為隱藏-->
                        <div class="SuccessBlock">
                            <div class="loading"></div>
                            <div class="redirectMessage"></div>
                        </div>
                    </div> <!-- /.formPanel -->
                </div><!-- /.row -->
            </div><!-- container -->

            <!-- Modal -->
            <div class="modal fade" id="movieModal" tabindex="-1" role="dialog" aria-labelledby="movieModal" aria-hidden="true">
                <div class="modal-dialog movieModal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">刪除劇照</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modal-body">
                            <p id="modal-message" style="font-weight: bold;">確定要刪除此劇照嗎?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary movieBtn" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-success movieBtn" id="btn-ModalConfirm">確定</button>
                        </div>
                    </div>
                </div>
            </div>

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
        var data_old_still_path;
        var fade_img_div;
        $('.old_still_image_group').on('click', '.del_old_still_img', function(){
            data_old_still_path = $(this).attr('data-old-still-path');
            fade_img_div = $(this).parent();
            console.log("fq");
            $('#movieModal').modal();
            return false;
        });

        $('.modal-footer #btn-ModalConfirm').on('click', function(){
            console.log(data_old_still_path);
            $("#movieModal").modal('hide');
            $.ajax({
                    method: "POST", // 傳遞表單的方式
                    url: "../phpfunction/ajax_del_single_file_admin.php", // 目標給哪個檔案
                    data: { // 傳送的資料 ，使用物件的方式傳送，
                        movie_id : $('#movie_id').val(),
                        file_path : data_old_still_path,
                        oper : "still"
                    },
                    dataType: 'json' // 設定該網站回應的格式
                })
                .done(function(data) {
                    // 檢查是否與資料庫資料存在
                    if (data['code'] == 0) {
                        toastr.success("刪除劇照成功!!", "刪除劇照");
                        fade_img_div.fadeOut("slow", function(){
                            // 淡出並且移除
                            $(this).remove();
                        }); 

                    } else {
                        toastr.error("刪除劇照失敗, 錯誤代碼:" + data['code'], "刪除劇照");
                    }

                    console.log(data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    // 失敗的時候 ex: 404, ...
                    alert("有錯誤發生，請查看錯誤訊息")
                    console.log(jqXHR.responseText);
                });
        });


        /*
         * 上傳的新劇照
         */
        $("div#still_image-holder").hide();
        $("#still_image").on('change', function() {
            // console.log($(this));
            var countFiles = this.files.length; //Get count of selected files

            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"]; // 符合的格式

            var image_holder = $("#still_image-holder");
            image_holder.empty();

            for (var i = 0; i < countFiles; i++) {
                var img_file = this.files[i];
                var fileType = img_file["type"];
                // 檢查是否為照片指定格式   ($.inArray -> 不存在回傳-1, 存在則回傳位置)
                if ($.inArray(fileType, ValidImageTypes) >= 0) {
                    var reader = new FileReader();
                    reader.onload = function(e) { // 照片load完成之後 將照片放入顯示圖片的div()
                        $("<img />", {
                            "src": e.target.result,
                            "class": "still-img"
                        }).appendTo(image_holder);
                    }
                    $("#still_image-holder").show();
                    reader.readAsDataURL(img_file);
                } else {
                    toastr.error("第 " + i + " 張圖請上傳正確照片格式(png, jpg)，否則無法正常預覽", "上傳格式錯誤");
                    image_holder.empty();
                    break;
                }
            }
        });

        $("#updateStillimageFrom").submit(function(){
            if ($('#still_image')[0].files.length == 0){
                $("#ErrorMessage").html("請上傳劇照!!");
                $('#still_image').focus();
                toastr.error($("#ErrorMessage").html());
                return false;
            }
            if ($('#still_image')[0].files.length != 0){
                if ($('#still_image-holder').has('img').length == 0)
                {
                    $("#ErrorMessage").html("上傳之劇照檔案格式錯誤!!");
                    $('#still_image').focus();
                    toastr.error($("#ErrorMessage").html());
                    return false;
                }
            }


            var form_data = new FormData(this);
            $.ajax({
                    method: "POST", // 傳遞表單的方式
                    url: "../phpfunction/updateStillimage_admin.php", // 目標給哪個檔案
                    data: form_data,
                    processData: false,
                    contentType: false,
                    dataType: 'json' // 設定該網站回應的格式
                })
                .done(function(data) {
                    // 檢查是否與資料庫資料存在
                    if (data['code'] == 0){
                        $("form#updateStillimageFrom").hide();
                        $(".movieFormPanel").css("width", "auto");
                        $(".SuccessBlock").show();
                        $(".loading").html("<i class='fas fa-spinner fa-pulse'></i>");
                        $(".redirectMessage").html("<span style='color: orange;'>新增劇照成功!!</span>，<span id='countDown'>5</span> 秒後更新並重新載入畫面");
                        // 倒數計時跳轉頁面
                        var count = 5;
                        setInterval(function(){
                            count--;
                            $("#countDown").html(count);
                            if (count == 0){
                                window.location.href="updateMovieStillimage.php?id=" + $('#movie_id').val();
                            }
                        }, 1000);
                        toastr.success(data['message']);
                        // window.location.href="memberLogin.php";
                    }
                    else{
                        console.log("code:" + data['code'] + ",message:" + data['message'] + ",失敗喇!");
                    }
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