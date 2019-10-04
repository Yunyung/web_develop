$(function() {
/*
 * 封面照片、電影劇照 瀏覽器端呈現
 */
    $("div#cover-image-holder").hide(); // 初始隱藏用來顯示圖片的div
    $("div#still_image-holder").hide();

    // 封面input改變時
    $("#cover_image").on('change', function() {
        console.log($(this)); // 可查看此input
        var img_file = this.files[0]; // 取得img 

        var fileType = img_file["type"]; // 檢查此檔案的Type是否符合格式
        var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"]; // 符合的格式

        var image_holder = $("#cover-image-holder"); // 取得暫存照片的div
        image_holder.empty();

        if ($.inArray(fileType, ValidImageTypes) >= 0) {
            // 檢查是否為照片指定格式   ($.inArray -> 不存在回傳-1, 存在則回傳位置)


            var reader = new FileReader();
            reader.onload = function(e) { // 照片load完成之後 將照片放入顯示圖片的div()
                $("<img />", {
                    "src": e.target.result,
                    "class": "cover-img"
                }).appendTo(image_holder);
            }
            $("#cover-image-holder").show();
            reader.readAsDataURL(img_file);
        } else {
            toastr.error("請上傳正確照片格式(png, jpg)，否則無法正常預覽", "上傳格式錯誤");
        }
    });

    $("#still_image").on('change', function() {
        // console.log($(this));
        var countFiles = this.files.length; //Get count of selected files

        var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"]; // 符合的格式

        var image_holder = $("#still_image-holder");
        image_holder.empty();

        for (var i = 0; i < countFiles; i++) {
            var img_file = this.files[i];
            var fileType = img_file["type"];
            // 檢查是否為照片指定格式   ($.inArray -> 不存在回傳-1, 存在則回傳位置)
            if ($.inArray(fileType, ValidImageTypes) >= 0) {
                var reader = new FileReader();
                reader.onload = function(e) { // 照片load完成之後 將照片放入顯示圖片的div()
                    $("<img />", {
                        "src": e.target.result,
                        "class": "still-img"
                    }).appendTo(image_holder);
                }
                $("#still_image-holder").show();
                reader.readAsDataURL(img_file);
            } else {
                toastr.error("第 " + i + " 張圖請上傳正確照片格式(png, jpg)，否則無法正常預覽", "上傳格式錯誤");
                image_holder.empty();
                break;
            }
        }
    });

/*
 *  動態偵測是否下架 調整商品排序
 */
    $('input:radio[name="isLaunched"]').on('change', function(){
        if ($(this).val() == 0){
            $('select[name="listOrder"]').append('<option value="NULL">＊商品沒有上架,無排序</option>');
            $('select[name="listOrder"]  option[value="NULL"]').prop('selected', true);
            $('select[name="listOrder"]').hide();
        }
        if ($(this).val() == 1){
            $('select[name="listOrder"]  option[value="NULL"]').remove();
            $('select[name="listOrder"]').show();
        }
    });

    
/*
 *  動態新增、刪除演員、導演欄位
 */
    var countDirectors = 1;
    $('#addDirectors').click(function(){
        countDirectors++;
        $('#dynamic-field-directors').append("<tr id='row_director_" + countDirectors + "'><td><input type='text' class='form-control' name='directors[]' placeholder='導演'></td><td><button tpye='button' id='" + countDirectors + "' class='btn btn-danger btn-remove-director movieBtn'>X</button></td></tr>");
    })

    $('table#dynamic-field-directors').on('click', '.btn-remove-director', function(){
        var button_id = $(this).attr("id");
        $('#row_director_' + button_id).remove();
    });

    var countActors = 1;
    $('#addActor').click(function(){
        countActors++;
        $('#dynamic-field-actors').append("<tr id='row_actor_" + countActors + "'><td><input type='text' class='form-control' name='actors[]' placeholder='演員'></td><td><button tpye='button' id='" + countActors + "' class='btn btn-danger btn-remove-actor movieBtn'>X</button></td></tr>");
        
    });

    $('table#dynamic-field-actors').on('click', '.btn-remove-actor', function(){
        var button_id = $(this).attr("id");
        $('#row_actor_' + button_id).remove();
    });




/*
 *  form 檢查
 */
    $("#addNewMovieForm").submit(function(){

        if ($('#chi_name').val() == ""){
            $("#ErrorMessage").html("請輸入電影中文名稱!!");
            $('#chi_name').focus();
            toastr.error($("#ErrorMessage").html());
            return false;
        }

        if ($('#cover_image')[0].files.length == 0){
            $("#ErrorMessage").html("請選擇封面圖片!!");
            $('#cover_image').focus();
            toastr.error($("#ErrorMessage").html());
            return false;
        }

        if ($('#cover-image-holder').has('img').length == 0){
            $("#ErrorMessage").html("封面檔案格式錯誤!!");
            $('#cover_image').focus();
            toastr.error($("#ErrorMessage").html());
            return false;
        }

        if ($('#still_image')[0].files.length != 0){
            if ($('#still_image-holder').has('img').length == 0)
            {
                $("#ErrorMessage").html("劇照檔案格式錯誤!!");
                $('#still_image').focus();
                toastr.error($("#ErrorMessage").html());
                return false;
            }
        }

        if ($('input:checkbox:checked').length == 0){
            $("#ErrorMessage").html("請勾選電影分類!!");
            $("#categoryfirst").focus();
            toastr.error($("#ErrorMessage").html());
            return false;
        }

        var all_ok = true;
        $('input[name="directors[]"]').each(function(index){
            // console.log($(this));
            if ($(this).val() == ""){
                $("#ErrorMessage").html("第 " +  (index + 1) + " 列導演欄位不得為空值");
                $(this).focus();
                toastr.error($("#ErrorMessage").html());
                all_ok = false;
                return false; // !!!!this breaks the .each iterations, returning early!!!
            }
        });

        if (!all_ok){
            return false;
        }

        $('input[name="actors[]"]').each(function(index){
            // console.log($(this));
            if ($(this).val() == ""){
                $("#ErrorMessage").html("第 " +  (index + 1) + " 列演員欄位不得為空值");
                $(this).focus();
                toastr.error($("#ErrorMessage").html());
                all_ok = false;
                return false; // !!!!this breaks the .each iterations, returning early!!!
            }
        });

        if (!all_ok){
            return false;
        }


        if ($('#price').val() == ""){
            $("#ErrorMessage").html("請輸入售價");
            $('#price').focus();
            toastr.error($("#ErrorMessage").html());
            return false;
        }

        if (!$("input:radio[name=isLaunched]").is(":checked")) {
            $("#ErrorMessage").html("請選擇是否將電影上架!!");
            $("#isLaunched").focus();
            toastr.error($("#ErrorMessage").html());
            return false;
        }

        if (!$("input:radio[name=isNewProduct]").is(":checked")) {
            $("#ErrorMessage").html("請選擇是否標記為新上映電影!!");
            $("#isNewProduct").focus();
            toastr.error($("#ErrorMessage").html());
            return false;
        }

        var form_data = new FormData(this);
        $.ajax({
                method: "POST", // 傳遞表單的方式
                url: "../phpfunction/addNewMovie_admin.php", // 目標給哪個檔案
                data: form_data,
                processData: false,
                contentType: false,
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['code'] == 0){
                    $("form#addNewMovieForm").hide();
                    $(".movieFormPanel").css("width", "auto");
                    $(".SuccessBlock").show();
                    $(".loading").html("<i class='fas fa-spinner fa-pulse'></i>");
                    $(".redirectMessage").html("<span style='color: orange;'>新增電影成功!!</span>，<span id='countDown'>5</span> 秒後自動轉跳至電影列表管理頁面 <br>或點擊  <a href='movieList.php'>電影列表管理</a>  手動轉跳");
                    // 倒數計時跳轉頁面
                    var count = 5;
                    setInterval(function(){
                        count--;
                        $("#countDown").html(count);
                        if (count == 0){
                            window.location.href="movieList.php";
                        }
                    }, 1000);
                    toastr.success(data['message']);
                    // window.location.href="memberLogin.php";
                }
                else{
                    console.log("code:" + data['code'] + ",message:" + data['message'] + ",失敗喇幹!");
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