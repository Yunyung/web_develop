$(function() {
/*
 *  ajax方式將值塞入
 */
    var form_movie_init_data;
    $.ajax({
            method: "POST", // 傳遞表單的方式
            url: "../phpfunction/getMovieData_admin.php", // 目標給哪個檔案
            data: {
                movie_id : $('#movie_id').val()
            },
            async: false, // 設定為非同步,執行完此才能往下執行
            dataType: 'json' // 設定該網站回應的格式
        })
        .done(function(data) {
            // 檢查是否與資料庫資料存在
            if (data['code'] == 0){
                form_movie_init_data = data['movie_data'];
            }
            else{
                toastr.success("失敗!");
                console.log("code:" + data['code'] + ",message:" + data['message'] + ",失敗喇!");
            }

            console.log(data);
            
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            // 失敗的時候 ex: 404, ...
            alert("有錯誤發生，請看console log")
            console.log(jqXHR.responseText);
        });  
    // 將ajax取得的資料放入指定欄位 
    $('div.Panel-Title').append("電影編輯-" + form_movie_init_data['chi_name']);
    $('input[id="chi_name"]').val(form_movie_init_data['chi_name']);
    $('input[id="eng_name"]').val(form_movie_init_data['eng_name']);
    $('input[id="releaseDate"]').val(form_movie_init_data['releaseDate']);
    $('input[id="trailer_path"]').val(form_movie_init_data['trailer_path']);
    $('textarea[id="introduce"]').val(form_movie_init_data['introduce']);
    if (form_movie_init_data['category'] != null){
        var category_cut = form_movie_init_data['category'].split(',');
        for (var i = 0;i < category_cut.length;i++){
            $('input:checkbox[name="category[]"][value="' + category_cut[i] + '"]').prop('checked', true);
        }
    }
    if (form_movie_init_data['Length'] != null){
        // 若電影長度不為null
        var Length_cut = form_movie_init_data['Length'].split(':'); // 字串切割
        hour = Length_cut[1];
        minute = Length_cut[2];
        $('select[name=hour] option[value="' + hour + '"]').prop('selected', true);
        $('select[name=minute] option[value="' + minute + '"]').prop('selected', true);
    }

    var countDirectors = 1; // 用於動態新增的欄位設定ID 方便新增刪除
    if (form_movie_init_data['directors'] != null){
        var directors_cut = form_movie_init_data['directors'].split(','); // 字串切割
        $('#dynamic-field-directors input:first-child').val(directors_cut[0]); // 第一個input欄位
        for (var i = 1;i < directors_cut.length;i++){
            countDirectors++;
            $('#dynamic-field-directors').append("<tr id='row_director_" + countDirectors + "'><td><input type='text' class='form-control' name='directors[]' value='" + directors_cut[i] + "' placeholder='導演'></td><td><button tpye='button' id='" + countDirectors + "' class='btn btn-danger btn-remove-director movieBtn'>X</button></td></tr>");
        }
    }

    var countActors = 1;
    if (form_movie_init_data['actors'] != null){
        var actors_cut = form_movie_init_data['actors'].split(','); // 字串切割
        $('#dynamic-field-actors input:first-child').val(actors_cut[0]); // 第一個input欄位
        for (var i = 1;i < actors_cut.length;i++){
            countActors++;
            $('#dynamic-field-actors').append("<tr id='row_actor_" + countActors + "'><td><input type='text' class='form-control' name='actors[]' value='" + actors_cut[i] + "' placeholder='演員'></td><td><button tpye='button' id='" + countActors + "' class='btn btn-danger btn-remove-actor movieBtn'>X</button></td></tr>");
        }
    }
    
    $('input[id="releaseDate"]').val(form_movie_init_data['releaseDate']);
    $('input[id="price"]').val(form_movie_init_data['price']);
    $('input:radio[name="isLaunched"][value="' + form_movie_init_data['isLaunched'] + '"]').prop('checked', true);
    $('input:radio[name="isNewProduct"][value="' + form_movie_init_data['isNewProduct'] + '"]').prop('checked', true);
    var rate_obj = {
        "普遍級" : 0,
        "保護級" : 1,
        "輔導級" : 2,
        "限制級" : 3
    };
    $('select[name="rate"] option[value="' + rate_obj[form_movie_init_data['rate']] +'"]').prop('selected', true);
    // listOrder設定初始化
    
    // 根據初始值有無上架 決定顯示排序選項及排序框隱藏與否 及 是否設定為null
    if (form_movie_init_data['isLaunched'] == 0){
        // 原本是下架, 則需有多出"max-listOrder + 1"的選項
        var maxlistOrder = $('select[name="listOrder"]').attr('data-max-listOrder'); // 取得目前listOrder的最大值
        $('select[name="listOrder"]').append("<option value='"+ (maxlistOrder*1 + 1) + "'>放最後</option>");

        $('input[name="origin_listOrder"]').val("NULL"); // 原本listOrder 初始值 用來PHP處理排序
        $('select[name="listOrder"]').append('<option value="NULL">＊商品沒有上架,無排序</option>');
        $('select[name="listOrder"]  option[value="NULL"]').prop('selected', true);
        $('select[name="listOrder"]').hide();
    }
    else if (form_movie_init_data['isLaunched'] == 1){

        $('input[name="origin_listOrder"]').val(form_movie_init_data['listOrder']);
        $('select[name="listOrder"] option[value="' + form_movie_init_data['listOrder'] + '"]').prop('selected', true);
    }
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
            $('select[name="listOrder"] option[value="' + form_movie_init_data['listOrder'] + '"]').prop('selected', true);
            $('select[name="listOrder"]').show();
        }
    });

/*
 *  動態新增、刪除演員、導演欄位
 */
    $('#addDirectors').click(function(){
        countDirectors++;
        $('#dynamic-field-directors').append("<tr id='row_director_" + countDirectors + "'><td><input type='text' class='form-control' name='directors[]' placeholder='導演'></td><td><button tpye='button' id='" + countDirectors + "' class='btn btn-danger btn-remove-director movieBtn'>X</button></td></tr>");
    })
    $('table#dynamic-field-directors').on('click', '.btn-remove-director', function(){
        var button_id = $(this).attr("id");
        $('#row_director_' + button_id).remove();
    });


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
    $("#updateMovieForm").submit(function(){
        if ($('#chi_name').val() == ""){
            $("#ErrorMessage").html("請輸入電影中文名稱!!");
            $('#chi_name').focus();
            toastr.error($("#ErrorMessage").html());
            return false;
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

        $.ajax({
                method: "POST", // 傳遞表單的方式
                url: "../phpfunction/updateMovie_admin.php", // 目標給哪個檔案
                data: $(this).serialize(),
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['code'] == 0){
                    $("form#updateMovieForm").hide();
                    $(".movieFormPanel").css("width", "auto");
                    $(".SuccessBlock").show();
                    $(".loading").html("<i class='fas fa-spinner fa-pulse'></i>");
                    $(".redirectMessage").html("<span style='color: orange;'>編輯電影成功!!</span>，<span id='countDown'>5</span> 秒後重新載入此頁");
                    // 倒數計時跳轉頁面
                    var count = 5;
                    setInterval(function(){
                        count--;
                        $("#countDown").html(count);
                        if (count == 0){
                            window.location.href="updateMovieDetailInfo.php?id=" + $('#movie_id').val();
                        }
                    }, 1000);
                    toastr.success(data['message']);
                }
                else{
                    console.log("code:" + data['code'] + ",message:" + data['message'] + ",失敗喇!");
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