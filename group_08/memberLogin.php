<?php
@session_start();
if (isset($_SESSION['is_Login']) && $_SESSION['is_Login']){
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>會員登入-彰師戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/business.css">
    <link rel="stylesheet" href="css/memberLogin.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body>
        <div id="wrapper">
            <!-- include navbar -->
            <?php include_once 'pageHeader.php';?>
                <div id="contentBanner">
                    <div class="container">
                        <div class="row">
                            <div class="movieFormPanel">
                                <div class="Panel-heading">
                                    <div class="Panel-Title">
                                        登入會員
                                    </div>
                                </div>
                                <form id="memberLoginForm" class="movieForm" action="#">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                        <i class="fas fa-user input-group-icon"></i>
                                                        <input type="text" id="userAccount" class="form-control form-control-sm" placeholder="用戶帳號">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                        <i class="fas fa-key input-group-icon"></i>
                                                        <input type="password" id="userPassword" class="form-control form-control-sm" placeholder="密碼">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                        <a href="forgetPassword.php" class="">忘記密碼?</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div id="ErrorMessage" style="display: none;">
                                        登入失敗，帳號或密碼輸入錯誤!
                                    </div>
                                    <div class="btnArea">
                                        <button class="btn movieBtn btn-orange" type="submit">送 出</button>
                                    </div>
                                    <div class="help-r">
                                        <div>還不是會員嗎？<a class="btn btn-dark movieBtn" href="memberRegister.php">加入會員</a></div>
                                    </div>
                                </form>
                                <!-- 成功註冊後 轉跳倒數的div 初始為隱藏-->
                                <div class="SuccessBlock">
                                    <div class="loading"></div>
                                    <div class="redirectMessage"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.contentBanner -->
                <!-- Footer -->
                <?php include_once 'footer.php';?>
        </div>
        <!-- /.wrapper -->
        <!-- /.wrapper -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JS -->
        <script src="js/commonUse.js"></script>
        <script src="js/memberLogin.js"></script>
</body>

</html>