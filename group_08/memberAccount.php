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
        <title>會員帳號-彰師戲院</title>
        <link rel="icon" href="img/favicon.ico" />
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/business.css">
        <!-- Custom styles -->
        <link rel="stylesheet" href="css/memberAccount.css">
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
                        <div class="col-sm-8 mx-auto">
                            <div class="movieFormPanel my-5">
                                <div class="Panel-heading Panel-heading-Account">
                                    <div class="Panel-Title" style="display: inline-block;">
                                        個人資料
                                    </div>
                                    <div class="memberInfoEditLink">
                                        <a href="javascipt:void(0)" class="btn-sm btn-pink movieBtn" id="editLink">編輯我的資料</a>
                                    </div>
                                </div>
                                <form id="memberInfoUpdateForm" method="POST" action="phpfunction/update_memberAccount.php">
                                    <table id="memberInfoTable" class="table table-hover table-bordered">
                                        <?
                                        $sql = "SELECT * FROM `user` WHERE `id` = {$_SESSION['id']}";
                                        $query = mysqli_query($_SESSION['link'], $sql);
                                        
                                        if (!$query):
                                        echo "sql:{$sql}" . mysqli_error();
                                        else :
                                        $row = mysqli_fetch_assoc($query);
                                    ?>
                                            <tr>
                                                <td>用戶編號：</td>
                                                <td>
                                                    <?= $row['id']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>真實姓名：</td>
                                                <td>
                                                    <?= $row['name'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>帳號：</td>
                                                <td>
                                                    <?= $row['userAccount'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>用戶密碼：</td>
                                                <td>********　<a class="float-right" href="AccountUpdatePassword.php?id=<?= $row['id']; ?>">修改密碼</a></td>
                                            </tr>
                                            <tr>
                                                <td>性別：</td>
                                                <td>
                                                    <input type="radio" name="sex" value="M" checked disabled> 男
                                                    <input type="radio" name="sex" value="F" <?=( $row[ 'sex']=="F" )? "checked" : "" ?> disabled>女
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>出生日期：</td>
                                                <td>
                                                    <?= $row['dateOfBirth'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>E-mail：</td>
                                                <td>
                                                    <input type="text" id="Email" name="Email" class="form-control" value="<?= $row['Email'] ?>" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>行動電話：</td>
                                                <td>
                                                    <input type="text" id="mobile" name="mobile" class="form-control" value="<?= $row['mobile'] ?>" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>站內暱稱：</td>
                                                <td>
                                                    <input type="text" id="userNickname" name="userNickname" class="form-control" value="<?= $row['userNickname'] ?>" disabled>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>註冊日期：</td>
                                                <td>
                                                    <?= $row['signUpDate'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>用戶權限：</td>
                                                <td>
                                                    <?= ($row['rank'] == "normal") ? "一般會員" : "管理者"; ?>
                                                </td>
                                            </tr>
                                            <? endif; ?>
                                    </table>
                                    <div id="ErrorMessage"></div>
                                    <div class="btnArea py-3">
                                        <button type="submit" class="btn btn-orange movieBtn">修改</button>
                                    </div>
                                </form>
                            </div> <!-- /.Panel -->
                        </div>
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
        <script src="js/commonUse.js"></script>
        <script>
        $(".btnArea").hide();
        $(function() {
            $("#editLink").on("click", function() {
                $("input:disabled").css("border", "1px solid orange");
                $("input:disabled").prop("disabled", false);
                $(".btnArea").show();
                toastr.info('可以更新你的資料囉!')
            });


            $("#memberInfoUpdateForm").submit(function(){
                var id_check = /[^a-zA-Z0-9]/g;
                var mail_check = /.+@.+\..+/;
                var number_check = /^09[0-9]{8}$/;
                // 基本檢查

                if (!$("#Email").val().match(mail_check)) {
                    $("#ErrorMessage").html("＊E-mail格式錯誤!");
                    $("#Email").focus();
                    return false;
                }

                if (!$("#mobile").val().match(number_check)) {
                    $("#ErrorMessage").html("＊行動電話格式錯誤!");
                    $("#mobile").focus();
                    return false;
                }

                if ($("#userNickname").val() == "") {
                    $("#ErrorMessage").html("＊請輸入帳號顯示之稱謂!");
                    $("#userNickname").focus();
                    return false;
                }
                alert("更新成功，請按確定後繼續操作!");
            });
        });
        </script>
    </body>

    </html>