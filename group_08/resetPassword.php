<?
    @session_start();
    require_once "DB_Setting/DB.php";
    // 確認是哪個使用者, 全部帳號讀出來之後一一進行md5比對
    $sql = "SELECT `id`, `userAccount` FROM `user`";
    $query = mysqli_query($_SESSION['link'], $sql);
    // 如果請求成功
    if ($query)
    {
        if (mysqli_num_rows($query) >= 1){
            $userResetCode = $_GET['resetCode'];
            while($row = mysqli_fetch_assoc($query))
            {
                $md5_userAccount = md5($row['userAccount']);
                if ($md5_userAccount == $userResetCode)
                {
                    $id = $row['id'];
                    $userAccount = $row['userAccount'];
                    break;
                }
            }
        }
        if ($userAccount == null)
        {
            header("Location: memberLogin.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>重設密碼-彰師戲院</title>
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
                            重設密碼
                        </div>
                    
                        <form id="resetPasswordForm" class="movieForm">
                            <input type="hidden" id="id" value="<?= $id ?>">
                            <input type="hidden" id="userResetCode" value="<?= $userResetCode ?>">
                            <span class="movieAzureAlert" style="margin-left: 5%;"><i class="fas fa-user"></i> <?= $userAccount ?> 您好, 輸入新密碼吧!</span>
                            <table class="table">
                                <tbody>
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
        $('#resetPasswordForm').submit(function(){
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

            $.post("phpfunction/ajax_forgetPassword.php", {id : $('#id').val(), new_userPassword : $('#new_userPassword').val(), resetCode: $('#userResetCode').val(), oper: "updatePassword"}, function(data){
                if (data['code'] != 0){
                    // code != 0 舊密碼輸入錯誤
                    $('#ErrorMessage').html("<i class='fas fa-exclamation-circle'></i>" + data['message']);
                    alert("發生錯誤! 轉跳至登入頁面");
                    window.location.href="memberAccount.php";

                }
                else{
                    // code = 0 無錯誤發生
                    $("#resetPasswordForm").hide();
                    $(".SuccessBlock").show();
                    $(".loading").html("<i class='fas fa-spinner fa-pulse'></i>");
                    $(".redirectMessage").html("<span style='color: orange;'>密碼更改成功,請至登入頁面進行登入!!</span><span id='countDown'> 5</span> 秒後自動轉跳至登入頁面 <br>或點擊  <a href='memberLogin.php'>登入頁面</a>  手動轉跳");
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