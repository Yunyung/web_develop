$(function() {
    $("#ErrorMessage").hide();
    $(".SuccessBlock").hide();
    $("#memberLoginForm").submit(function() {
        $.ajax({
                method: "POST", // 傳遞表單的方式
                url: "phpfunction/ajax_verify_userLogin.php", // 目標給哪個檔案
                data: { // 傳送的資料 ，使用物件的方式傳送，
                    userAccount: $("#userAccount").val(),
                    userPassword: $("#userPassword").val()
                },
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['isExist'] == true) {
                    $("#memberLoginForm").hide();
                    $(".SuccessBlock").show();
                    $(".loading").html("<i class='fas fa-spinner fa-pulse'></i>");
                    $(".redirectMessage").html("<span style='color: orange;'>登入成功!!</span>，<span id='countDown'>5</span> 秒後自動轉跳至頁面 <br>或點擊  <a href='index.php'>頁面</a>  手動轉跳");
                    // 倒數計時跳轉頁面
                    var count = 5;
                    setInterval(function(){
                        count--;
                        $("#countDown").html(count);
                        if (count == 0){
                            window.location.href="index.php";
                        }
                    }, 1000);
                } else {
                    $("#ErrorMessage").show();
                    $("#userPassword").val("");
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
});
