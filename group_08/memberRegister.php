<?php
@session_start();
if (isset($_SESSION['is_Login']) && $_SESSION['is_Login'])  
{
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
        <title>會員註冊-彰師戲院</title>
        <link rel="icon" href="img/favicon.ico" />
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Custom styles -->
        <link rel="stylesheet" href="css/business.css">
        <link rel="stylesheet" href="css/memberRegister.css">
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
                        <div class="movieFormPanel my-5">
                            <div class="Panel-heading">
                                <div class="Panel-Title">
                                    加入會員
                                </div>
                            </div>
                            <form id="memberRegisterForm" class="" action="#">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="AreaTitleHelp">個人資料</td>
                                        </tr>
                                        <tr>
                                            <td>姓名：</td>
                                            <td>
                                                <input type="text" id="name" class="form-control form-control-sm" placeholder="姓名">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>用戶帳號</td>
                                            <td>
                                                <input type="text" id="userAccount" class="form-control form-control-sm" placeholder="帳號" required>
                                                <div class="invalid-feedback" id="userAccount-invalid-feedback"></div>
                                                <div class="valid-feedback" id="userAccount-valid-feedback"></div>
                                                <span class="help-block">※ 您登入此網站所使用的帳號！</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>設定密碼：</td>
                                            <td>
                                                <input type="password" id="userPassword" class="form-control form-control-sm" maxlength="16" placeholder="密碼">
                                                <span class="help-block">※ 請輸入16 碼以內的英數字, 請勿使用特殊符號！</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>密碼確認：</td>
                                            <td>
                                                <input type="password" id="userPassword2" class="form-control form-control-sm" maxlength="16" placeholder="確認密碼">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>性別</td>
                                            <td>
                                                <input type="radio" name="sex" value="M"> 男
                                                <input type="radio" name="sex" value="F"> 女
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>出生年月</td>
                                            <td colspan="3">
                                                <input class="form-control  form-control-sm" type="date" name="dateOfBirth" id="dateOfBirth">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="AreaTitleHelp">聯絡資料</td>
                                        </tr>
                                        <tr>
                                            <td>電子信箱</td>
                                            <td>
                                                <input type="email" name="Email" id="Email" class="form-control form-control-sm" placeholder="電子信箱">
                                                <span class="help-block">※我們將會驗證您的電子信箱，請務必填寫正確。</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>行動電話</td>
                                            <td>
                                                <input type="text" name="mobile" id="mobile" class="form-control form-control-sm" placeholder="主要聯絡方式">
                                                <span class="help-block">※ 例: 0929123456</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="AreaTitleHelp">帳號個人訊息</td>
                                        </tr>
                                        <tr>
                                            <td>帳號暱稱</td>
                                            <td>
                                                <input type="text" name="userNickname" id="userNickname" class="form-control form-control-sm" placeholder="帳號顯示之稱謂">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="right">
                                                <input type="checkbox" id="agreement" name="agreement">了解並同意我們的個資保護聲明。
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="right">
                                                <p class="movieAlizarinCrimsonAlert"><i class="fas fa-bell"></i> 資料欄位皆為必填</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="FormErrorMessageArea">
                                    <div id="ErrorMessage"></div>
                                </div>
                                <div class="btnArea">
                                    <button class="btn movieBtn btn-primary" id="registerBtn" type="submit">送 出</button>
                                </div>
                            </form>
                            <!-- 成功註冊後 轉跳倒數的div 初始為隱藏-->
                            <div class="SuccessBlock">
                                <div class="loading"></div>
                                <div class="redirectMessage"></div>
                            </div>
                        </div>
                        <!-- End FromPanel -->
                    </div>
                </div>
            </div>
            <!-- /.contentBanner -->
            <!-- Footer -->
            <?php include_once 'footer.php';?>
        </div>
        <!-- /.wrapper -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- Custom JS -->
        <script src="js/commonUse.js"></script>
        <script src="js/memberRegister.js"></script>
    </body>

    </html>