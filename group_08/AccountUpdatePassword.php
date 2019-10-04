<?
    @session_start();
    if (!(isset($_SESSION['is_Login']) && $_SESSION['is_Login'])){
        header("Location: memberLogin.php");
    }
    require_once "DB_Setting/DB.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>更改密碼-彰師戲院</title>
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
                            更改會員密碼
                        </div>
                        <form id="updatePassowrdForm" class="movieForm">
                            <input type="hidden" id="id" value="<?= $_GET['id']?>">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <i class="fas fa-unlock-alt input-group-icon"></i>
                                                <input type="password" id="old_userPassword" name="old_userPassword" class="form-control form-control-sm" maxlength="16"placeholder="舊密碼">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <i class="fas fa-key input-group-icon"></i>
                                                <input type="password" id="new_userPassword" name="new_userPassword" class="form-control form-control-sm" maxlength="16" placeholder="新密碼">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <i class="fas fa-key input-group-icon"></i>
                                                <input type="password" id="new_userPassword2" class="form-control form-control-sm" maxlength="16" placeholder="新密碼確認">
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
                            <div class="loading"></div>
                            <div class="redirectMessage"></div>
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
        $('#updatePassowrdForm').submit(function(){
            if ( $('#old_userPassword').val() == "" ){
                $('#ErrorMessage').html("＊請輸入舊密碼");
                $('#old_userPassword').focus();
                return false;
            }

            if ( $('#new_userPassword').val() == "" ){
                $('#ErrorMessage').html("＊請輸入新密碼");
                $('#new_userPassword').focus();
                return false;
            }

            if ( $('#new_userPassword').val() != $('#new_userPassword2').val() ){
                $('#ErrorMessage').html("＊兩次密碼輸入不同");
                $('#new_userPassword2').focus();
                return false;
            }

            $.post("phpfunction/ajax_updatePassword.php", {id : $('#id').val(), old_userPassword : $('#old_userPassword').val(), new_userPassword : $('#new_userPassword').val()}, function(data){
                if (data['code'] != 0){
                    // code != 0 舊密碼輸入錯誤
                    $('#ErrorMessage').html("<i class='fas fa-exclamation-circle'></i>" + data['message']);
                    $('#old_userPassword').val("");
                    $('#old_userPassword').focus();
                }
                else{
                    // code = 0 無錯誤發生
                    $("#updatePassowrdForm").hide();
                    $(".SuccessBlock").show();
                    $(".loading").html("<i class='fas fa-spinner fa-pulse'></i>");
                    $(".redirectMessage").html("<span style='color: orange;'>密碼更改成功!!</span><span id='countDown'> 5</span> 秒後自動轉跳至個人資料頁面 <br>或點擊  <a href='memberAccount.php'>個人資料</a>  手動轉跳");
                    var count = 5;
                    setInterval(function(){
                        count--;
                        $("#countDown").html(count);
                        if (count == 0){
                            window.location.href="memberAccount.php";
                        }

                    }, 1000);
                }
                console.log(data);
            }, "json");

            return false;
        });
    });
    </script>
</body>

</html>