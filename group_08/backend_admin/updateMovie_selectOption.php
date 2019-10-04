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
    <title>後台-編輯電影選擇-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap4 core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/business.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="../fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
    <style>
    a.updateMovie-link {
        padding: 0;
        margin-bottom: 60px;
        height: 100px;
        font-size: 50px;
        line-height: 100px;
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
                                <li class="breadcrumb-item active" aria-current="page">編輯項目選擇</li>
                            </ol>
                        </nav>
                    </div>
                    <? $id = $_GET['id']; ?>
                    <a class="btn btn-blue movieBtn col-12 updateMovie-link" href="updateMovieDetailInfo.php?id=<?= $id ?>">
                        編輯文字、影片、排序、其他
                    </a>
                    <a class="btn btn-pink movieBtn col-12 updateMovie-link" href="updateMovieCoverImage.php?id=<?= $id ?>"> 
                        編輯封面圖片
                    </a>
                    <a class="btn btn-orange movieBtn col-12 updateMovie-link" href="updateMovieStillimage.php?id=<?= $id ?>">
                        編輯劇照
                    </a>
                </div>
                <!-- /.row -->
            </div>
            <!-- container -->
        </div>
        <!-- /.contentBanner -->
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
</body>

</html>