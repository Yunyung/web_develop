<body class="movieBg">
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 mt-3" id="currentPath">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">後台首頁</a></li>
                                <li class="breadcrumb-item"><a href="memberList.php">會員管理</a></li>
                                <li class="breadcrumb-item active" aria-current="page">會員資料修改</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-sm-12">
                        <form method="POST" id="MemberEditForm" action="../phpfunction/updateMember_admin.php">
                            <?
                                    $sql = "SELECT * FROM `user` WHERE `id` = '{$_GET['id']}'";
                                    $query = mysqli_query($_SESSION['link'], $sql);
                                    if ($query){
                                        $row = mysqli_fetch_assoc($query);
                                ?>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <div class="form-group">
                                    <label for="name">真實姓名</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $row['name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="userAccount">用戶帳號</label>
                                    <input type="text" class="form-control" id="userAccount" name="userAccount" value="<?= $row['userAccount'] ?>">
                                    <small id="userAccountHelp" class="form-text text-muted">※4-20個字,英文數字組成</small>
                                </div>
                                <div class="form-group">
                                    <label for="userPassword">用戶密碼</label>
                                    <input type="text" class="form-control" id="userPassword" name="userPassword" value="<?= $row['userPassword'] ?>">
                                    <small id="userPasswordHelp" class="form-text text-muted">※此密碼經md5加密, 若更新亦會經md5加密</small>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">性別</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="F" name="sex" value="M" checked>
                                                <label class="form-check-label" for="F">
                                                    男
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="M" name="sex" value="F" <?=( $row[ 'sex']=="F" )? "checked" : "" ?>>
                                                <label class="form-check-label" for="M">
                                                    女
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dateOfBirth">出生日期</label>
                                    <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" value="<?= $row['dateOfBirth'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Email">信箱</label>
                                    <input type="email" class="form-control" id="Email" name="Email" value="<?= $row['Email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">手機</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $row['mobile'] ?>"><small id="mobileHelp" class="form-text text-muted">※ 例: 0929123456</small>
                                </div>
                                <div class="form-group">
                                    <label for="userNickname">站內暱稱</label>
                                    <input type="text" class="form-control" id="userNickname" name="userNickname" value="<?= $row['userNickname'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="rank">權限</label>
                                    <select class="form-control" id="rank" name="rank">
                                        <option value="normal" <?=( $row[ 'rank']=="normal" )? "selected":null; ?> >一般用戶</option>
                                        <option value="admin" <?=( $row[ 'rank']=="admin" )? "selected":null; ?>>管理者</option>
                                    </select>
                                    <small id="rankHelp" class="form-text text-muted">※選擇normal(一般用戶) 或 admin(管理者)</small>
                                </div>
                                <div class="form-group">
                                    <label for="signUpDate">註冊日期</label>
                                    <span><?= $row['signUpDate'] ?></span>
                                </div>
                                <?
                                        }
                                        else{
                                                echo "sql:{$sql}" . ",錯誤訊息:" . mysqli_error($_SESSION['link']);
                                        }
                                    ?>
                                    <div class="FormErrorMessageArea" style="text-align: center">
                                        <div id="ErrorMessage" style="color:red;"></div>
                                    </div>
                                    <div class="btnArea" style="text-align: center; margin: 10px">
                                        <button type="submit" class="btn btn-orange movieBtn">送出</button>
                                    </div>
                        </form>
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
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/commonUse.js"></script>
    <script>
    // 檢查
    $("#MemberEditForm").submit(function() {
        var message = "";
        var id_check = /[^a-zA-Z0-9]/g;
        var number_check = /^09[0-9]{8}$/;
        var mail_check = /.+@.+\..+/;
        var userAccount = $("#userAccount").val();

        if ($("#name").val() == "") {
            $("#ErrorMessage").html("請輸入姓名!!");
            $("#name").focus();
            return false;
        }

        if (userAccount == "")
            message = "＊請輸入帳號!!"
        else if (userAccount.indexOf(' ') >= 0)
            message = "＊帳號不可有空格!!";
        else if (userAccount.length < 4 || userAccount.length > 20)
            message = "＊帳號長度限制為4-20!!";
        else if (userAccount.match(id_check))
            message = "＊帳號僅限英數字!!";

        if (message) {
            $("#ErrorMessage").html(message);
            $("#userAccount").focus();
            return false;
        }


        if ($("#userPassword").val() == "") {
            $("#ErrorMessage").html("＊請輸入密碼!!");
            $("#userPassword").focus();
            return false;
        }

        if (!$("input:radio[name=sex]").is(":checked")) {
            $("#ErrorMessage").html("＊請選擇性別!!");
            $("#sex").focus();
            return false;
        }

        if ($("#dateOfBirth").val() == "") {
            $("#ErrorMessage").html("＊請輸入出生年月!!");
            $("#dateOfBirth").focus();
            return false;
        }

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
        alert("更新完成，請按確定後繼續操作!");
    });
    </script>
</body>

</html>