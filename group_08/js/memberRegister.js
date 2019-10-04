$(function() {
    // 先將註冊成功的BLOCK隱藏，成功寫入資料庫後顯示
    $(".SuccessBlock").hide();
    /**
     * 利用ajax當帳號輸入後，檢查帳號是否已經存在
     */

    var id_check = /[^a-zA-Z0-9]/g;
    $("#userAccount").keyup(function() {
        var userAccount = $(this).val();
        if (userAccount == "") {
            $("#userAccount").removeClass("is-valid");
            $("#userAccount").addClass("is-invalid");
            $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>請輸入帳號!!");
        } else if (userAccount.indexOf(' ') >= 0) {
            $("#userAccount").removeClass("is-valid");
            $("#userAccount").addClass("is-invalid");
            $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>帳號不可有空格!!");
        } else if (userAccount.length < 4 || userAccount.length > 20) {
            // 長度非5-20
            $("#userAccount").removeClass("is-valid");
            $("#userAccount").addClass("is-invalid");
            $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>長度限制為4-20!!");
        } else if (userAccount.match(/[^a-zA-Z0-9]/g)) {
            $("#userAccount").removeClass("is-valid");
            $("#userAccount").addClass("is-invalid");
            $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>帳號僅限英數字!!");
        } else {
            $.ajax({
                    method: "POST", // 傳遞表單的方式
                    url: "phpfunction/ajax_userAccountCheck.php", // 目標給哪個檔案
                    data: { // 傳送的資料 ，使用物件的方式傳送，
                        userAccount: $(this).val()
                    },
                    dataType: 'json' // 設定該網站回應的格式
                })
                .done(function(data) {
                    // 檢查是否與資料庫資料存在
                    if (data['isExist'] == true) {
                        $("#userAccount").removeClass("is-valid");  
                        $("#userAccount").addClass("is-invalid");
                        $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>此帳號已存在");
                    } else {
                        $("#userAccount").removeClass("is-invalid");
                        $("#userAccount").addClass("is-valid");
                        $("#userAccount-valid-feedback").html("<i class='far fa-check-circle'></i>您可以使用此帳號");
                    }

                    console.log(data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    // 失敗的時候 ex: 404, ...
                    alert("有錯誤發生，請查看錯誤訊息")
                    console.log(jqXHR.responseText);
                });
        }


    });


    // 帳號提交時檢查
    $("#memberRegisterForm").submit(function() {
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
        else if (userAccount.length < 4 || userAccount.lenth > 20)
            message = "＊帳號長度限制為4-20!!";
        else if (userAccount.match(id_check))
            message = "＊帳號僅限英數字!!";
        else if ($("#userAccount").hasClass("is-invalid")) // 若上述皆合格，卻有此class(ajax內動態新增) 則帳號重複
            message = "＊帳號重複!!"; 

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

        if ($("#userPassword").val() != $("#userPassword2").val()) {
            $("#ErrorMessage").html("＊2次密碼輸入不相同!!");
            $("#userPassword2").focus();
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

        if (!$("#agreement").is(":checked")) {
            $("#ErrorMessage").html("＊請了解並同意我們的個資保護聲明。");
            $("#agreement").focus();
            return false;
        }


        // 檢查皆成功 利用ajax將資料存入資料庫
        $.ajax({
                method: "POST", // 傳遞表單的方式
                url: "phpfunction/ajax_addNewUser.php", // 目標給哪個檔案
                data: { // 傳送的資料 ，使用物件的方式傳送，
                    name : $("#name").val(),
                    userAccount : $("#userAccount").val() ,
                    userPassword : $("#userPassword").val() ,
                    sex : $('input[name=sex]:checked').val(),
                    dateOfBirth : $("#dateOfBirth").val() ,
                    Email : $("#Email").val() ,
                    mobile : $("#mobile").val() ,
                    userNickname : $("#userNickname").val() ,
                },
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['isSuccess'] == true){
                    $("#memberRegisterForm").hide();
                    $(".SuccessBlock").show();
                    $(".loading").html("<i class='fas fa-spinner fa-pulse'></i>");
                    $(".redirectMessage").html("<span style='color: orange;'>申請成功, 請至登入頁面進行登入!!</span>，<span id='countDown'>5</span> 秒後自動轉跳至登入頁面 <br>或點擊  <a href='memberLogin.php'>登入頁面</a>  手動轉跳");
                    var count = 5;
                    setInterval(function(){
                        count--;
                        $("#countDown").html(count);
                        if (count == 0){
                            window.location.href="memberLogin.php";
                        }

                    }, 1000);
                }
                else{
                    alert("註冊失敗，請確認您的電腦連線狀態，若還無法解決，請聯絡系統工程人員");
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
});