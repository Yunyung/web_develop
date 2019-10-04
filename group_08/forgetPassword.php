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
    <title>忘記密碼-彰師戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/business.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body class="movieBg">
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <div class="container">
                <div class="row">
                    <div class="movieFormPanel">
                        <div class="Panel-heading Panel-heading-Account">
                            忘記密碼
                        </div>
                        <form id="forgetPasswordForm" class="movieForm">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <i class="fas fa-user input-group-icon"></i>
                                                <input type="text" id="userAccount" class="form-control form-control-sm" placeholder="輸入用戶帳號">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <i class="fas fa-envelope-square input-group-icon"></i>
                                                <input type="mail" id="Email" class="form-control form-control-sm" placeholder="請輸入帳號之信箱">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div id="ErrorMessage"></div>
                            <div class="btnArea">
                                <button class="btn movieBtn btn-orange" type="submit">送 出</button>
                            </div>
                        </form>
                        <!-- 成功註冊後 轉跳倒數的div 初始為隱藏-->
                        <div class="SuccessBlock">
                            <p id="SuccessMessage"></p>
                        </div>
                    </div>
                    <!-- /.Panel -->
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
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- toastrJS -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Custom JS -->
    <script scr="js/commonUse.js"></script>
    <script>
    $(function() {
        $(".SuccessBlock").hide();
        $('#forgetPasswordForm').submit(function(){
            var message = "";
            var id_check = /[^a-zA-Z0-9]/g;
            var mail_check = /.+@.+\..+/;
            var userAccount = $("#userAccount").val();
            if (userAccount == "")
                message = "＊請輸入帳號!!"
            else if (userAccount.indexOf(' ') >= 0)
                message = "＊帳號不可有空格!!";
            else if (userAccount.length < 4 || userAccount.lenth > 20)
                message = "＊帳號長度限制為4-20!!";
            else if (userAccount.match(id_check))
                message = "＊帳號僅限英數字!!";

            if (message) {
                $("#ErrorMessage").html(message);
                $("#userAccount").focus();
                return false;
            }


            if (!$("#Email").val().match(mail_check)) {
                $("#ErrorMessage").html("＊E-mail格式錯誤!");
                $("#Email").focus();
                return false;
            }

            $.post("phpfunction/ajax_forgetPassword.php", { userAccount : $('#userAccount').val(), Email : $("#Email").val(), oper: "getResetCode"}, function(data){
                if (data['code'] == 3){
                    // code != 0 舊密碼輸入錯誤
                    $('#ErrorMessage').html("<i class='fas fa-exclamation-circle'></i>" + data['message']);
                    $('#userAccount').val("");
                    $("#Email").val("");
                }
                else{
                    // code = 0 無錯誤發生
                    $("#forgetPasswordForm").hide();
                    $(".SuccessBlock").show();
                    $("#SuccessMessage").html(data['message']);
                    
                }
                console.log(data);
            }, "json");

            return false;
        });
    });
    </script>
</body>

</html>